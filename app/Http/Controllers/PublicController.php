<?php

namespace App\Http\Controllers;

use App\Jobs\GeneratePreviewsJob;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class PublicController extends Controller
{
    public function index(Request $request): View
    {
        $client = $request->client;
        return view('public.index', compact('client'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:docx,pdf'

        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $extension = pathinfo($filename)['extension'];

            // Move the uploaded file to a storage location
            $actual = $file->storeAs('files/' . $request->client->getFolder(), $filename);
            $actual = storage_path('app/' . $actual);

            Storage::disk('thumbs')->makeDirectory($request->client->getFolder());
            $target_file = Storage::disk('thumbs')->path($request->client->getFolder()) . '/' . $filename . '.png';
            $pdf = new Pdf($actual);
            $pdf->setPage(1)->setOutputFormat('png')->saveImage($target_file);
            $destination = $request->client->getFolder() . '/preview/' . basename($actual);
            dispatch(new GeneratePreviewsJob($pdf, $destination));
            return view('partials.uploads');
        }

        return 'No file uploaded.';
    }

    public function printModal(Request $request)
    {
        $request->validate([
            'file' => 'required|string'
        ]);
        $file = $request->get('file');
        $pdf = new Pdf(storage_path('app/files/' . str_replace('/preview', '', $file)));
        return view('partials.modal-print', compact('file', 'pdf'));
    }

    public function getSummary(Request $request)
    {
        $file = $request->get('file');
        if (substr($file, strripos($file, '.') + 1) == 'pdf') {
            // $out=shell_exec('pwd');
            $out = shell_exec('gs -q  -o - -sDEVICE=inkcov ' . $file);
            if (strpos($out, 'error') === false) {
                $a = explode("\n", $out);
                $asd = array_pop($a);
                $output = [];
                $colored_counter = 0;
                $bw_counter = 0;
                $colored = [];
                $bw = [];
                foreach ($a as $b => $c) {
                    $output[$b] = explode('  ', $c);
                    $cyan = floatval($output[$b][0]);
                    $magenta = floatval($output[$b][1]);
                    $yellow = floatval($output[$b][2]);
                    // $black=substr($output[$b][3],0,strpos($output[$b][3],' '));
                    // foreach(explode('  ',$c) as $colvals){
                    //     if(int)
                    // }
                    if ($cyan > 0 || $magenta > 0 || $yellow > 0) {
                        $colored_counter++;
                        array_push($colored, $b + 1);
                    } else {
                        $bw_counter++;
                        array_push($bw, $b + 1);
                    }
                }
                $res = [
                    'pages' => sizeof($output),
                    'colored' => $colored_counter,
                    'bw_counter' => $bw_counter,
                    'bwpages' => $bw,
                    'colored_pages' => $colored
                ];
                return response()->json($res);
            } else {
                abort(404, 'document not found');
            }
        } else {
            abort(422, 'invalid filetype');
        }
    }
    public function destroy(Request $request)
    {
        $request->validate([
            'file' => 'required|string'
        ]);
        $file = $request->get('file');
        Storage::disk('files')->deleteDirectory($file);
        Storage::disk('thumbs')->delete(str_replace('/preview', '', $file . '.png'));
        Storage::disk('files')->delete(str_replace('/preview', '', $file));
        return back()->with('alert', ['type' => 'success', 'message' => 'deleted']);
    }
}

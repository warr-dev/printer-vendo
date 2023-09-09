<?php

namespace App\Http\Controllers;

use App\Helper\FileHelper;
use App\Jobs\GeneratePreviewsJob;
use App\Models\Upload;
use Error;
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
            $metadata = pathinfo($filename);
            $extension = $metadata['extension'];

            // Move the uploaded file to a storage location
            Storage::disk('files')->makeDirectory($request->client->getFolder());
            Storage::disk('files')->setVisibility($request->client->getFolder(), 'public');
            $actual = $file->storeAs('files/' . $request->client->getFolder(), $filename);
            $actual = storage_path('app/' . $actual);

            Storage::disk('thumbs')->makeDirectory($request->client->getFolder());
            Storage::disk('thumbs')->setVisibility($request->client->getFolder(), 'public');
            $target_file = Storage::disk('thumbs')->path($request->client->getFolder()) . '/' . $filename . '.png';
            $pdf = new Pdf($actual);
            $pdf->setPage(1)->setOutputFormat('png')->saveImage($target_file);
            $destination = $request->client->getFolder() . '/preview/' . basename($actual);
            Upload::create([
                'client_id' => $request->client->id,
                'file_name' => $filename,
                'metadata' => json_encode([
                    'size' =>  Storage::disk('files')->size($request->client->getFolder() . "/$filename"),
                    'last_modified' =>  Storage::disk('files')->lastModified($request->client->getFolder() . "/$filename"),
                    'mime_type' => Storage::disk('files')->mimeType($request->client->getFolder() . "/$filename"),
                    'pages' => $pdf->getNumberOfPages()
                ]),
            ]);
            // dispatch(new GeneratePreviewsJob($pdf, $destination));
            return view('public.partials.uploads');
        }

        return 'No file uploaded.';
    }

    public function printModal(Request $request, Upload $upload)
    {
        // $request->validate([
        //     // 'file' => 'required|string'
        //     'id' => 'required|numeric|exist:uploads'
        // ]);
        // $file = $request->get('file');
        // $pages=12;
        return view('public.partials.modal-print', compact('upload'));
    }

    public function getSummary(Request $request, Upload $upload)
    {
        // $request->validate([
        //     'file' => 'required|string'
        // ]);
        // $file = basename($request->get('file'));
        $filepath = $upload->getFilePath();
        $path = storage_path('app/files/' . $filepath);
        $mime = Storage::disk('files')->mimeType($filepath);
        $isPDF = $mime === 'application/pdf';
        if (!$isPDF)
            throw new Error('file was not pdf');
        $colors = FileHelper::getPdfPageColors($path);
        return response()->json($colors);
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
        Upload::where('file_name', $file)->delete();
        return back()->with('alert', ['type' => 'success', 'message' => 'deleted']);
    }
}

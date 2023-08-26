<?php

namespace App\Http\Controllers;

use App\Helper\FileHelper;
use App\Jobs\GeneratePreviewsJob;
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
            $extension = pathinfo($filename)['extension'];

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
        $request->validate([
            'file' => 'required|string'
        ]);
        $file = basename($request->get('file'));
        $path = storage_path('app/files/' . $request->client->getFolder() . '/' . $file);
        $mime = Storage::disk('files')->mimeType($request->client->getFolder() . '/' . $file);
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
        return back()->with('alert', ['type' => 'success', 'message' => 'deleted']);
    }
}

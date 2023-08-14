<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class PublicController extends Controller
{
    public function index(Request $request): View
    {
        $client = $request->client;
        return view('public', compact('client'));
    }
    public function uploadDoc(Request $request)
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
            Storage::disk('files')->makeDirectory($request->client->getFolder() . '/preview/' . basename($actual));
            $destination = dirname($actual) . '/preview/' . basename($actual);
            $pdf->saveAllPagesAsImages($destination);
            return view('partials.uploads');
        }

        return 'No file uploaded.';
    }

    public function printModal(Request $request)
    {
        $request->validate([
            'file' => 'required|string'
        ]);
        $file= $request->get('file');
        $pdf=new Pdf(storage_path('app/files/'.str_replace('/preview','',$file)));
        return view('partials.modal-print', compact('file','pdf'));
    }
}

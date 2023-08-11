<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            $extension = pathinfo($file)['extension'];

            // Move the uploaded file to a storage location
            $actual = $file->storeAs('files/' . $request->client->getFolder(), $filename);
            $actual=storage_path('app/'.$actual);

            $target_file = storage_path('app/thumbs/' . $request->client->getFolder()) . '/' . $filename . "." . $extension;
            $pdf = new Pdf($actual);
            $pdf->setPage(1)->saveImage($target_file);

            $files = [];

            // return Response::success('document uploaded successful');
            return view('partials.uploads', ['files' => ['sda', 'sdas']]);
        }

        return 'No file uploaded.';
    }
}

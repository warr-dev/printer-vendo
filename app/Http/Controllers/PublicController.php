<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublicController extends Controller
{
    public function index(Request $request): View
    {
        $client=$request->client;
        return view('public',compact('client'));
    }
    public function uploadDoc(Request $request) {
        $request->validate([
            'file' => 'required|mimes:docx,pdf'

        ]);
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            // Move the uploaded file to a storage location
            $file->storeAs('files/'.$request->client->getFilePath(), $filename);

            $files=[];

            // return Response::success('document uploaded successful');
            return view('partials.uploads',['files' => ['sda','sdas']]);
        }

        return 'No file uploaded.';
    }
}

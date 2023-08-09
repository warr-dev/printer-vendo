<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request): View
    {
        $client=Client::getClientByIp($request->ip());
        return view('public',compact('client'));
    }
    
}

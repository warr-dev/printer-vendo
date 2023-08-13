<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    public function index() {
        return view('admin.pages.dashboard');
    }
    public function logs() {
        return view('admin.logs');
    }
}

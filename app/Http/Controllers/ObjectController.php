<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjectController extends Controller
{
    public function index()
    {
        return view('clients.objects.index');
    }
}

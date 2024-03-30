<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Objet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ObjectController extends Controller
{
    public function index()
    {
        $objects = Client::query()->with('objets.project')->find(Auth::guard('client')->id());
        $query = request()->query('query');
        if($query){
            $objects = $objects->objets->where('project_id', (int) $query);
        }
        $objects = $objects->objets;
        return view('clients.objects.index', compact('objects'));
    }

    public function details(Request $request, $id)
    {
        $object = Objet::query()->with('project')->find($id);
        return view('clients.objects.details', compact('object'));
    }
}

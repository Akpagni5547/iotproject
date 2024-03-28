<?php

namespace App\Http\Controllers;

use App\Models\Objet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ObjectController extends Controller
{
    public function index()
    {
        $query = request()->query('query');
        $objects = Objet::query()
            ->when($query, function ($query, $search) {
                return $query->where('project_id', (int) $query);
            })
            ->with('project')
            ->get();
        Log::info('Objects: ', ['objects' => $objects]);
        return view('clients.objects.index', compact('objects'));
    }

    public function details(Request $request, $id)
    {
        $object = Objet::query()->with('project')->find($id);
        return view('clients.objects.details', compact('object'));
    }
}

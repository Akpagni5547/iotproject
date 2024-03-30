<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $user_id = Auth::guard('client')->id();
        $projects = Project::query()->with('objets')->where('client_id',$user_id )->get();
        return view('clients.projects.index', compact('projects'));
    }
}

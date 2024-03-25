<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()->with('objets')->with('controllers')->get();
        return view('clients.projects.index', compact('projects'));
    }
}

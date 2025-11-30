<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::active()
            ->ordered()
            ->paginate(12);
        
        return view('pages.portfolio', compact('projects'));
    }

    public function show(Project $project)
    {
        if (!$project->active) {
            abort(404);
        }
        
        return view('pages.project', compact('project'));
    }
}

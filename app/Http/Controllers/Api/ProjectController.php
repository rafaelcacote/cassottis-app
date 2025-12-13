<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Lista todos os projetos ativos
     */
    public function index(Request $request)
    {
        $query = Project::active()->ordered();

        // Filtro por featured
        if ($request->has('featured') && $request->featured == 'true') {
            $query->featured();
        }

        // Paginação
        $perPage = $request->get('per_page', 12);
        $projects = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $projects->map(function ($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'short_description' => $project->short_description,
                    'description' => $project->description,
                    'image' => $project->image ? asset('storage/' . $project->image) : null,
                    'gallery' => $project->gallery ? array_map(function ($img) {
                        return asset('storage/' . $img);
                    }, $project->gallery) : [],
                    'technologies' => $project->technologies ?? [],
                    'project_url' => $project->project_url,
                    'github_url' => $project->github_url,
                    'demo_url' => $project->demo_url,
                    'status' => $project->status,
                    'completion_date' => $project->completion_date?->format('Y-m-d'),
                    'featured' => $project->featured,
                    'created_at' => $project->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $project->updated_at->format('Y-m-d H:i:s'),
                ];
            }),
            'pagination' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
            ]
        ], 200);
    }

    /**
     * Mostra um projeto específico
     */
    public function show(Project $project)
    {
        if (!$project->active) {
            return response()->json([
                'success' => false,
                'message' => 'Projeto não encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $project->id,
                'title' => $project->title,
                'short_description' => $project->short_description,
                'description' => $project->description,
                'image' => $project->image ? asset('storage/' . $project->image) : null,
                'gallery' => $project->gallery ? array_map(function ($img) {
                    return asset('storage/' . $img);
                }, $project->gallery) : [],
                'technologies' => $project->technologies ?? [],
                'project_url' => $project->project_url,
                'github_url' => $project->github_url,
                'demo_url' => $project->demo_url,
                'status' => $project->status,
                'completion_date' => $project->completion_date?->format('Y-m-d'),
                'featured' => $project->featured,
                'created_at' => $project->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $project->updated_at->format('Y-m-d H:i:s'),
            ]
        ], 200);
    }
}


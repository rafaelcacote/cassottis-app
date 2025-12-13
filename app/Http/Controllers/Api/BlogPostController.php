<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Lista todos os posts publicados
     */
    public function index(Request $request)
    {
        $query = BlogPost::published()->recent();

        // Filtro por featured
        if ($request->has('featured') && $request->featured == 'true') {
            $query->featured();
        }

        // Filtro por tag
        if ($request->has('tag')) {
            $query->byTag($request->tag);
        }

        // Paginação
        $perPage = $request->get('per_page', 10);
        $posts = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'excerpt' => $post->excerpt,
                    'content' => $post->content,
                    'featured_image' => $post->featured_image ? asset('storage/' . $post->featured_image) : null,
                    'tags' => $post->tags ?? [],
                    'status' => $post->status,
                    'published_at' => $post->published_at?->format('Y-m-d H:i:s'),
                    'views' => $post->views,
                    'featured' => $post->featured,
                    'reading_time' => $post->reading_time,
                    'author' => $post->user ? [
                        'id' => $post->user->id,
                        'name' => $post->user->name,
                        'email' => $post->user->email,
                    ] : null,
                    'created_at' => $post->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $post->updated_at->format('Y-m-d H:i:s'),
                ];
            }),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ], 200);
    }

    /**
     * Mostra um post específico
     */
    public function show(BlogPost $post)
    {
        if ($post->status !== 'published' || ($post->published_at && $post->published_at->isFuture())) {
            return response()->json([
                'success' => false,
                'message' => 'Post não encontrado'
            ], 404);
        }

        // Incrementar visualizações
        $post->incrementViews();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'featured_image' => $post->featured_image ? asset('storage/' . $post->featured_image) : null,
                'tags' => $post->tags ?? [],
                'status' => $post->status,
                'published_at' => $post->published_at?->format('Y-m-d H:i:s'),
                'views' => $post->views,
                'featured' => $post->featured,
                'reading_time' => $post->reading_time,
                'author' => $post->user ? [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                    'email' => $post->user->email,
                ] : null,
                'created_at' => $post->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $post->updated_at->format('Y-m-d H:i:s'),
            ]
        ], 200);
    }
}


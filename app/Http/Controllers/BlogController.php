<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()
            ->recent()
            ->paginate(10);
        
        return view('pages.blog', compact('posts'));
    }

    public function show(BlogPost $post)
    {
        if ($post->status !== 'published' || ($post->published_at && $post->published_at->isFuture())) {
            abort(404);
        }
        
        // Incrementar visualizações
        $post->incrementViews();
        
        return view('pages.post', compact('post'));
    }
}

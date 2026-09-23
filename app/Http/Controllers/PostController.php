<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Daftar berita untuk publik
    public function index()
    {
        $posts = Post::latest()->paginate(6); // tampilkan 6 berita per halaman
        return view('posts.index', compact('posts'));
    }

    // Detail berita untuk publik
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }
}

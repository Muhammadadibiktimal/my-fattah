<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Post;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        $posts = Post::latest()->take(6)->get();
        // $programs = Program::all();
        $videos = Video::latest()->take(6)->get(); // tambahin ini

        return view('home', compact('heroes', 'posts', 'videos','programs'));
    }

}

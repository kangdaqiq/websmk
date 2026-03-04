<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Setting;

class PublicController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $posts = Post::where('status', 'published')->latest()->take(3)->get();
        $galleries = Gallery::latest()->take(8)->get();

        $teachers = \App\Models\Teacher::all();

        return view('public.index', compact('settings', 'posts', 'galleries', 'teachers'));
    }

    public function posts()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $posts = Post::where('status', 'published')->latest()->paginate(9);
        return view('public.posts', compact('settings', 'posts'));
    }

    public function post(Post $post)
    {
        if ($post->status !== 'published')
            abort(404);
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('public.post', compact('settings', 'post'));
    }

    public function galleries()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $galleries = Gallery::latest()->paginate(12);
        return view('public.galleries', compact('settings', 'galleries'));
    }

    public function about()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('public.about', compact('settings'));
    }

    public function contact()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('public.contact', compact('settings'));
    }

}

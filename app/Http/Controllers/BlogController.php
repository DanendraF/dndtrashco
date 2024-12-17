<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('news.blog'); // Pastikan 'blog.blade.php' ada di folder resources/views
    }
}

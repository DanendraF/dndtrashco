<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Menampilkan semua blog
    public function index()
    {
        $blogs = BlogPost::all();
        return view('admin.blog', compact('blogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('blog_images', 'public');
        }

        BlogPost::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => Str::slug($request->title),
            'cover_image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Blog post created successfully.');
    }


    public function edit($id)
    {
        $blog = BlogPost::findOrFail($id);
        return response()->json($blog);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $blog = BlogPost::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->slug = Str::slug($request->title);

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('blog_images', 'public');
            $blog->cover_image = $imagePath;
        }

        $blog->save();

        return redirect()->back()->with('success', 'Blog post updated successfully.');
    }


    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        $blog->delete();

        return redirect()->back()->with('success', 'Blog post deleted successfully.');
    }


    public function blogsection()
    {
        $blogs = BlogPost::all();
        return view('news.blogsection', compact('blogs'));
    }


    public function blogdetails($slug)
    {
        $blog = BlogPost::where('slug', $slug)->first();
        $latestposts = BlogPost::latest()->take(3)->get();

        return view('news.blogdetails', compact('blog', 'latestposts'));

    }


}

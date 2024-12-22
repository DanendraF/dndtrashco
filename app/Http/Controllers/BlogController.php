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
            'cover_image' => 'required|image',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $coverImage = $request->file('cover_image');
        $imagePath = $coverImage->store('images', 'public');

        $blogPost = BlogPost::create([
            'cover_image' => $imagePath,
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title)
        ]);

        if ($blogPost) {
            return response()->json([
                'success' => true,
                'message' => 'Blog post added successfully.',
                'data' => $blogPost,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create blog post.'
            ], 500);
        }
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

        // Jika ada gambar baru, simpan
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('blog_images', 'public');
            $blog->cover_image = $imagePath;
        }

        // Menyimpan perubahan
        $blog->save();

        return response()->json([
            'success' => true,
            'message' => 'Blog post updated successfully.',
            'data' => $blog
        ]);
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        $deleted = $blog->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Blog post deleted successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete blog post.'
            ], 500);
        }
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

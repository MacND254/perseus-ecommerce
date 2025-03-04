<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);

        $posts->transform(function ($post) {
            $post->image_url = $post->image ? asset('storage/' . $post->image) : asset('images/default-placeholder.png');
            return $post;
        });

        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->image_url = $post->image ? asset('storage/' . $post->image) : asset('images/default-placeholder.png');

        return view('blog.show', compact('post'));
    }

    public function adminIndex()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $timestamp = now()->format('YmdHis');
        $extension = $request->file('image')->getClientOriginalExtension();
        $customFileName = 'post_' . $timestamp . '.' . $extension;
        $imagePath = $request->file('image')->storeAs('posts', $customFileName, 'public');
    }

    // Generate a slug from the title
    $slug = Str::slug($request->title);

    Post::create([
        'title' => $request->title,
        'slug' => $slug, // Ensure the generated slug is passed here
        'category_id' => $request->category_id,
        'content' => $request->content,
        'image' => $imagePath,
    ]);

    return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
}



    public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = $post->image;

    // Handle Image Update
    if ($request->hasFile('image')) {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $timestamp = now()->format('YmdHis');
        $extension = $request->file('image')->getClientOriginalExtension();
        $customFileName = 'post_' . $timestamp . '.' . $extension;
        $imagePath = $request->file('image')->storeAs('posts', $customFileName, 'public');
    }

    // Update the Slug
    $slug = $post->slug; // Keep the existing slug
    if ($request->title !== $post->title) {
        $slug = Str::slug($request->title);



        if (empty($slug)) {
            throw new \Exception('Slug generation failed. Title may be empty or invalid.');
        }

        // Ensure Slug Uniqueness
        $originalSlug = $slug;
        $counter = 1;
        while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
    }

    $post->update([
        'title' => $request->title,
        'slug' => $slug,
        'category_id' => $request->category_id,
        'content' => $request->content,
        'image' => $imagePath,
    ]);

    return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
}


    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post; // Assuming Post is the model for blog posts
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Fetch paginated posts
        $posts = Post::with('category')->paginate(10); // Eager load 'category' relationship

        // Return the view with posts
        return view('blog.index', compact('posts'));
    }
}

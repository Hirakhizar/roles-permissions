<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Method to show all posts
    public function index()
    {
        $authenticUser=Auth::user();
        $posts = Post::with('category')->get();
        return view('admin.posts', compact('posts','authenticUser'));
    }

    // Method to show the form for adding a new post
    public function create()
    {
        $authenticUser=Auth::user();
        $categories=Category::get();
        return view('admin.createPost',compact('authenticUser','categories'));
    }

    // Method to store the new post
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required', // Rich text content
            'category_id' => 'required|exists:categories,id', // Ensure the category exists
            'status' => 'required|in:published,draft,archived', // Validate status
        ]);
    
        $user=Auth::user()->id;
        // Create a new post
        Post::create([
            'title' => $request->title,
            'content' => $request->content, // Save rich text content
            'author_id' => $user, // Assign the current logged-in user as the author
            'category_id' => $request->category_id, // Assign the selected category
            'status' => $request->status, // Assign the selected status
        ]);
    
        // Redirect back with a success message
        return redirect()->route('posts')->with('success', 'Post added successfully!');
    }
    
}

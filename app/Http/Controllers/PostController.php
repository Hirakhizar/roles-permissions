<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Add this line

class PostController extends Controller
{
    use AuthorizesRequests; // Use the trait here
    // Method to show all posts
    public function index()
    {
        // Authorize the user to view posts
        $this->authorize('viewAny', Post::class);

        $authenticUser = Auth::user();
        $posts = Post::with('category', 'author')->get();
        $categories = Category::all(); // Use all() for clarity
        return view('admin.posts', compact('posts', 'authenticUser', 'categories'));
    }

    // Method to show the form for adding a new post
    public function create()
    {
        // Authorize the user to create a post
        $this->authorize('create', Post::class);

        $authenticUser = Auth::user();
        $categories = Category::all();
        return view('admin.createPost', compact('authenticUser', 'categories'));
    }

    // Method to store the new post
    public function store(Request $request)
    {
        // Authorize the user to create a post
        $this->authorize('create', Post::class);

        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'status' => 'required|in:published,draft,archived',
        ]);

        $user = Auth::id(); // Get the authenticated user's ID

        // Create a new post
        Post::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->description,
            'status' => $request->status,
            'author_id' => $user, // Assuming the user is authenticated
        ]);

        // Redirect with a success message
        return redirect()->route('posts')->with('success', 'Post created successfully!');
    }

    // Method to show the form for editing a post
    public function edit(Post $post)
    {
        // Authorize the user to update the post
        $this->authorize('update', $post);

        $authenticUser = Auth::user();
        $categories = Category::all();
        return view('admin.editPost', compact('post', 'authenticUser', 'categories'));
    }

    // Method to update the post
    public function update(Request $request, Post $post)
    {
        // Authorize the user to update the post
        $this->authorize('update', $post);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:published,draft,archived',
        ]);

        // Update the post with validated data
        $post->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('posts')->with('success', 'Post updated successfully.');
    }

    // Method to delete the post
    public function destroy(Post $post)
    {
        // Authorize the user to delete the post
        $this->authorize('delete', $post);

        $post->delete();
        return redirect()->back()->with('success', 'Post Deleted!');
    }
}

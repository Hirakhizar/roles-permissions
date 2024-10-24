<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class PostPolicy
{

    /**
     * Determine if the user can view any posts (Admin and Editor can view all posts).
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('editor')|| $user->hasRole('author');
    }

    /**
     * Determine if the user can view the post (Writers can view their own posts, Admin and Editor can view all).
     */
    public function view(User $user, Post $post)
    {
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            return true;
        }

        // Writers can only view their own posts
        return $user->id === $post->author_id;
    }

    /**
     * Determine if the user can create posts (Writers, Editors, and Admins can create posts).
     */
    public function create(User $user)
    {
        return $user->hasRole('author') || $user->hasRole('editor') || $user->hasRole('admin');
    }

    /**
     * Determine if the user can update the post (Writers can update their own, Admin and Editor can update any).
     */
    public function update(User $user, Post $post)
    {
        Log::info("User  ID: {$user->id}, Post Author ID: {$post->author_id}");
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            return true;
        }
        return $user->id === $post->author_id;
    }

    /**
     * Determine if the user can delete the post (Admin and Editor can delete any post, Writers can delete their own).
     */
    public function delete(User $user, Post $post)
    {
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            return true;
        }

        return $user->id === $post->author_id;
    }

    /**
     * Determine if the user can restore the post (Admin can restore any post).
     */
    public function restore(User $user, Post $post)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine if the user can permanently delete the post (Admin can force delete any post).
     */
    public function forceDelete(User $user, Post $post)
    {
        return $user->hasRole('admin');
    }
}

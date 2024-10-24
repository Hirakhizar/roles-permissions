@extends('layouts.masterFile')

@section('head_script')
@endsection
@section('content')
    <div class="container">
        <h2 class="mt-4">Add New Post</h2>

        <!-- Display success or error messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <!-- Title field -->
            <div class="mb-3 ">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control " id="title" name="title" required>
            </div>

            <!-- Category dropdown -->
            <div class="mb-3 w-25">
                <label for="category" class="form-label">Category</label>
                <select name="category_id" class="form-control" id="category" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Content field using Rich Text Editor -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <!-- Status dropdown -->
            <div class="mb-3 w-25">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Post</button>
        </form>
    </div>
@endsection

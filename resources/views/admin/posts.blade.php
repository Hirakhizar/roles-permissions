@extends('layouts.masterFile')

@section('content')
    <div class="container">
        <h2 class="mt-4">All Posts</h2>

        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Add New Post</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                @can('view', $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{!! $post->content !!}</td> <!-- Unescaped HTML content -->

                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->status }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>
                            @can('update',$post)
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPostModal"
                            data-id="{{ $post->id }}" data-title="{{ $post->title }}"
                            data-category="{{ $post->category_id }}" data-status="{{ $post->status }}"
                            data-content="{{ htmlspecialchars($post->content) }}">
                            Edit
                        </button>
                            @endcan
                         
                           @can('delete',$post)
                           <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDeletion(event, '{{ $post->id }}');">
                                Delete
                            </button>
                        </form>
                           @endcan
                           
                           
                           
                        </td>
                    </tr>
                    @endcan
                @endforeach
              
            </tbody>
        </table>
    </div>

    <!-- Modal for editing post -->
    <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPostForm" action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        
                        
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="editPostTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editPostTitle" name="title" required>
                        </div>

                        <!-- Category dropdown -->
                        <div class="mb-3">
                            <label for="editPostCategory" class="form-label">Category</label>
                            <select name="category_id" class="form-control" id="editPostCategory" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="editPostContent" class="form-label">Content</label>
                            <textarea name="content" id="editPostContent" class="form-control"></textarea>
                        </div>

                        <!-- Status dropdown -->
                        <div class="mb-3">
                            <label for="editPostStatus" class="form-label">Status</label>
                            <select name="status" class="form-control" id="editPostStatus" required>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 CDN -->
    <script>
   


    // Function to confirm deletion using SweetAlert2
    function confirmDeletion(event, postId) {
        event.preventDefault(); // Prevent the form from submitting immediately

        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this post!",
            icon: "warning",
            showCancelButton: true, // This option must be set to true
            confirmButtonColor: "#dc3545", // Bootstrap danger color
            cancelButtonColor: "#6c757d", // Bootstrap secondary color
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel" // Add the cancel button text
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, find the form and submit it
                var form = event.target.closest('form');
                form.submit();
            } else if (result.isDismissed) {
                // Optional: show a message or perform an action on dismiss
                Swal.fire("Your Post Is Safe!");
            }
        });
    }

    // Populate the modal with post details
    var editPostModal = document.getElementById('editPostModal');
    editPostModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var postId = button.getAttribute('data-id'); // Extract post ID
        var postTitle = button.getAttribute('data-title'); // Extract post title
        var postCategory = button.getAttribute('data-category'); // Extract post category ID
        var postContent = button.getAttribute('data-content'); // Extract post content
        var postStatus = button.getAttribute('data-status'); // Extract post status

        // Update the modal's content
        var form = document.getElementById('editPostForm');
        form.action = '/posts/update/' + postId; // Set the form action to the update route

        var inputTitle = document.getElementById('editPostTitle');
        inputTitle.value = postTitle; // Set the input value to the current post title

        var selectCategory = document.getElementById('editPostCategory');
        selectCategory.value = postCategory; // Set the category select to the current post category

        var selectContent = document.getElementById('editPostContent');
        selectContent.value = postContent; // Set the content value

        var selectStatus = document.getElementById('editPostStatus');
        selectStatus.value = postStatus; // Set the status select to the current post status
    });
</script>
@endsection

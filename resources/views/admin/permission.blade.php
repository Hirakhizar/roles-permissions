@extends('layouts.masterFile')

@section('content')
    <div class="container">
        <h2 class="mt-4">Add New Permission</h2>

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

        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Permission Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Role</button>
            <a href="{{ route('permissions') }}" class="btn btn-secondary">Cancel</a>
        </form>

        <h2 class="mt-5">All Permissions</h2>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Permission Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                data-id="{{ $permission->id }}" data-name="{{ $permission->name }}">
                                Edit
                            </button>
                            <form action="{{ route('permissions.destroy', ['id' => $permission->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmDeletion(event, '{{ $permission->id }}');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for editing role -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editRoleForm" action="{{ route('permissions.update',0) }}" method="POST">
                        <!-- Placeholder ID -->
                        @csrf
                 
                        <div class="mb-3">
                            <label for="editRoleName" class="form-label">Permission Name</label>
                            <input type="text" class="form-control" id="editRoleName" name="name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Permission</button>
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
    function confirmDeletion(event, roleId) {
        event.preventDefault(); // Prevent the form from submitting immediately

        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this role!",
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
                Swal.fire("Your Role Is Safe!");
            }
        });
    }

        // Populate the modal with the role details
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var roleId = button.getAttribute('data-id'); // Extract info from data-* attributes
            var roleName = button.getAttribute('data-name');

            // Update the modal's content
            var modalTitle = editModal.querySelector('.modal-title');
            modalTitle.textContent = 'Edit Role: ' + roleName;

            var form = document.getElementById('editRoleForm');
            form.action = '/permissions/update/' + roleId; // Set the form action to the update route
            var input = document.getElementById('editRoleName');
            input.value = roleName; // Set the input value to the current role name
        });
    </script>
@endsection


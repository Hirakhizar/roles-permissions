@extends('layouts.masterFile')
@section('content')
    <div class="container">
        <h1 class="text-center">Assign Roles to Users</h1>
        <form action="{{ route('assign.roles.store') }}" method="POST">
            @csrf

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Users</th>
                            @foreach ($roles as $role)
                                <th>{{ $role->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                @foreach ($roles as $role)
                                    <td class="text-center">
                                        <div class="role-toggle" data-user-id="{{ $user->id }}"
                                            data-role-id="{{ $role->id }}">
                                            <input type="hidden" name="roles[{{ $user->id }}][{{ $role->id }}]"
                                                class="role-value" value="default"
                                                data-initial-state="{{ $user->hasRole($role) ? 'enabled' : 'disabled' }}">

                                            <!-- Enable and Disable icons -->
                                            <i class="fas fa-check-circle enable-icon text-success {{ $user->hasRole($role) ? '' : 'd-none' }}"
                                                style="cursor:pointer;"></i>
                                            <i class="fas fa-times-circle disable-icon text-danger {{ !$user->hasRole($role) ? '' : 'd-none' }}"
                                                style="cursor:pointer;"></i>



                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Assign Roles</button>
        </form>



    </div>
    <div class="container">
        <h1 class="text-center">Assign Permissions to Roles</h1>
        <form action="{{ route('assign.permissions.store') }}" method="POST">
            @csrf

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Permissions</th>
                            @foreach ($roles as $role)
                                <th>{{ $role->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                @foreach ($roles as $role)
                                    <td class="text-center">
                                        <div class="permission-toggle" data-role-id="{{ $role->id }}"
                                            data-permission-id="{{ $permission->id }}">
                                            <input type="hidden"
                                                name="permissions[{{ $role->id }}][{{ $permission->id }}]"
                                                class="permission-value" value="default"
                                                data-initial-state="{{ $role->hasPermissionTo($permission) ? 'enabled' : 'disabled' }}">

                                            <!-- Icons for enable/disable -->
                                            <i class="fas fa-check-circle enable-icon text-success {{ $role->hasPermissionTo($permission) ? '' : 'd-none' }}"
                                                style="cursor:pointer;"></i>
                                            <i class="fas fa-times-circle disable-icon text-danger {{ !$role->hasPermissionTo($permission) ? '' : 'd-none' }}"
                                                style="cursor:pointer;"></i>

                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Assign Permissions</button>
        </form>

    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Toggle for role assignment
        $('.role-toggle').click(function() {
            const roleValueInput = $(this).find('.role-value');
            const enableIcon = $(this).find('.enable-icon');
            const disableIcon = $(this).find('.disable-icon');
            const initialState = roleValueInput.data('initial-state'); // Get the initial state
    
            // Toggle between enabled and disabled
            if (enableIcon.hasClass('d-none')) {
                roleValueInput.val('enabled');
                enableIcon.removeClass('d-none');
                disableIcon.addClass('d-none');
            } else {
                roleValueInput.val('disabled');
                enableIcon.addClass('d-none');
                disableIcon.removeClass('d-none');
            }
    
            // If the state matches the initial state, reset to 'default' (no change)
            if (roleValueInput.val() === initialState) {
                roleValueInput.val('default');
            }
        });
    
        // Toggle for permission assignment
        $('.permission-toggle').click(function() {
            const permissionValueInput = $(this).find('.permission-value');
            const enableIcon = $(this).find('.enable-icon');
            const disableIcon = $(this).find('.disable-icon');
            const initialState = permissionValueInput.data('initial-state'); // Get the initial state
    
            // Toggle between enabled and disabled
            if (enableIcon.hasClass('d-none')) {
                permissionValueInput.val('enabled');
                enableIcon.removeClass('d-none');
                disableIcon.addClass('d-none');
            } else {
                permissionValueInput.val('disabled');
                enableIcon.addClass('d-none');
                disableIcon.removeClass('d-none');
            }
    
            // If the state matches the initial state, reset to 'default' (no change)
            if (permissionValueInput.val() === initialState) {
                permissionValueInput.val('default');
            }
        });
    });
    </script>
@endsection

@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0"><i class="fas fa-user-shield me-2"></i>Role Management</h2>
                    @can('role-create')
                        <a class="btn btn-success" href="{{ route('roles.create') }}">
                            <i class="fas fa-plus me-1"></i> Create New Role
                        </a>
                    @endcan
                </div>
                <hr class="mt-2">
            </div>
        </div>

        @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Roles List</h5>
                    <div class="d-flex">
                        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search roles...">
                    </div>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="80px" class="text-center">#</th>
                                <th>Role Name</th>
                                <th width="300px" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $key => $role)
                                <tr>
                                    <td class="text-center align-middle">{{ ++$i }}</td>
                                    <td class="align-middle">
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-sm btn-outline-info" href="{{ route('roles.show', $role->id) }}" 
                                               data-bs-toggle="tooltip" title="Show Role">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @can('role-edit')
                                                <a class="btn btn-sm btn-outline-primary" href="{{ route('roles.edit', $role->id) }}" 
                                                   data-bs-toggle="tooltip" title="Edit Role">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('role-delete')
                                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" 
                                                      onsubmit="return confirm('Are you sure you want to delete this role?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            data-bs-toggle="tooltip" title="Delete Role">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">No roles found. Create your first role!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($roles->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }} entries
                        </div>
                        {!! $roles->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Initialize tooltips
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });

        // Simple search functionality
        $('#searchInput').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endsection
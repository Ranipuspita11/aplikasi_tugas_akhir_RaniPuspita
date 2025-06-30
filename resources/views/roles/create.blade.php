@extends('layouts.main')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1"><i class="fas fa-user-shield text-primary me-2"></i>Create New Role</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Roles
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Validation Error</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i>Role Details</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Role Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                            <input type="text" class="form-control" id="name" name="name" 
                                   placeholder="Enter role name (e.g., admin, manager)" required>
                        </div>
                        <div class="form-text">Use lowercase letters and underscores if needed</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold d-block mb-3">Permissions</label>
                        <div class="permissions-container border rounded p-3 bg-light">
                            <div class="row g-3">
                                @foreach ($permission->groupBy(function($item) {
                                    $parts = explode('-', $item->name);
                                    return count($parts) > 1 ? $parts[0] : 'general';
                                }) as $group => $permissions)
                                    <div class="col-md-4">
                                        <div class="permission-group card h-100 border-0 shadow-sm">
                                            <div class="card-header bg-white">
                                                <h6 class="mb-0 text-capitalize text-primary">
                                                    <i class="fas fa-folder me-1"></i> {{ $group }}
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($permissions as $value)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" 
                                                               id="perm-{{ $value->id }}" name="permission[]" 
                                                               value="{{ $value->id }}">
                                                        <label class="form-check-label d-block" for="perm-{{ $value->id }}">
                                                            <span class="text-capitalize">
                                                                {{ str_replace($group.'-', '', $value->name) }}
                                                            </span>
                                                            <small class="text-muted d-block">{{ $value->name }}</small>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-text">Select permissions to assign to this role</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Role
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="text-center mt-4 text-muted">
            <small>Role Management System &copy; {{ date('Y') }}</small>
        </footer>
    </div>
@endsection

@section('styles')
<style>
    .permissions-container {
        max-height: 500px;
        overflow-y: auto;
    }
    
    .permission-group {
        transition: transform 0.2s;
    }
    
    .permission-group:hover {
        transform: translateY(-3px);
    }
    
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    /* Custom scrollbar */
    .permissions-container::-webkit-scrollbar {
        width: 8px;
    }
    
    .permissions-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .permissions-container::-webkit-scrollbar-thumb {
        background: #0d6efd;
        border-radius: 10px;
    }
    
    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
</style>
@endsection
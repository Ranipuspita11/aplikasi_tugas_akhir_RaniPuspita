@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="m-0">
                        <i class="fas fa-user-shield text-warning"></i> Edit Role: {{ $role->name }}
                    </h2>
                    <a class="btn btn-outline-secondary" href="{{ route('roles.index') }}">
                        <i class="fa fa-arrow-left"></i> Back to Roles
                    </a>
                </div>
                <hr class="mt-2 bg-warning">
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Validation Error!</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-gradient-warning text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit"></i> Role Information
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-4">
                        <label for="name" class="font-weight-bold">Role Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-tag text-warning"></i>
                                </span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control" 
                                   value="{{ old('name', $role->name) }}" placeholder="Enter role name" required>
                        </div>
                        <small class="form-text text-muted">Example: admin, manager, editor</small>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold d-block mb-3">Permissions</label>
                        
                        <div class="permissions-container border rounded p-3 bg-light">
                            <div class="row">
                                @foreach ($permission->groupBy(function($item) {
                                    return explode('-', $item->name)[0] ?? 'other';
                                }) as $group => $permissions)
                                    <div class="col-md-4 mb-3">
                                        <div class="permission-group card h-100">
                                            <div class="card-header bg-white py-2">
                                                <h6 class="mb-0 text-capitalize text-warning">
                                                    <i class="fas fa-folder-open mr-1"></i> {{ $group }}
                                                </h6>
                                            </div>
                                            <div class="card-body p-2">
                                                @foreach ($permissions as $value)
                                                    <div class="custom-control custom-checkbox my-1">
                                                        <input type="checkbox" class="custom-control-input" 
                                                               id="perm-{{ $value->id }}" name="permission[]" 
                                                               value="{{ $value->id }}"
                                                               {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                        <label class="custom-control-label d-flex align-items-center" for="perm-{{ $value->id }}">
                                                            <span class="text-capitalize">
                                                                {{ str_replace($group.'-', '', $value->name) }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <small class="form-text text-muted">Select permissions to assign to this role</small>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="fas fa-save"></i> Update Role
                        </button>
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary px-4 ml-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-light text-right">
                <small class="text-muted">Last updated: {{ $role->updated_at->format('M d, Y H:i') }}</small>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
    }
    
    .permissions-container {
        max-height: 500px;
        overflow-y: auto;
    }
    
    .permission-group {
        border: 1px solid #eee;
        transition: transform 0.2s;
    }
    
    .permission-group:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    
    .permission-group .card-header {
        background-color: #f8f9fa;
    }
    
    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
        background-color: #ffc107;
        border-color: #ffc107;
    }
    
    hr {
        height: 2px;
        opacity: 0.8;
    }
    
    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }
    
    .input-group-text {
        transition: all 0.3s;
    }
    
    .input-group:focus-within .input-group-text {
        background-color: #ffc107;
        color: white;
    }
    
    /* Custom scrollbar for permissions */
    .permissions-container::-webkit-scrollbar {
        width: 8px;
    }
    
    .permissions-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .permissions-container::-webkit-scrollbar-thumb {
        background: #ffc107;
        border-radius: 10px;
    }
    
    .permissions-container::-webkit-scrollbar-thumb:hover {
        background: #ffab00;
    }
</style>
@endsection
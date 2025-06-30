@extends('layouts.main')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1"><i class="fas fa-user-shield text-primary me-2"></i>Role Details</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $role->name }}</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Roles
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>Role Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="detail-item">
                            <h6 class="detail-label">Role Name</h6>
                            <p class="detail-value">{{ $role->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-item">
                            <h6 class="detail-label">Created At</h6>
                            <p class="detail-value">{{ $role->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="permissions-section">
                    <h5 class="section-title mb-3"><i class="fas fa-key me-2"></i>Assigned Permissions</h5>
                    @if(!empty($rolePermissions))
                        <div class="permissions-container">
                            @foreach($rolePermissions->groupBy(function($item) {
                                $parts = explode('-', $item->name);
                                return count($parts) > 1 ? $parts[0] : 'general';
                            }) as $group => $permissions)
                                <div class="permission-group mb-4">
                                    <h6 class="group-title text-primary">
                                        <i class="fas fa-folder me-1"></i> {{ ucfirst($group) }}
                                    </h6>
                                    <div class="permissions-list">
                                        @foreach($permissions as $permission)
                                            <span class="permission-badge">
                                                {{ str_replace($group.'-', '', $permission->name) }}
                                                <small class="text-muted d-block">{{ $permission->name }}</small>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-circle me-1"></i> No permissions assigned to this role
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Last updated: {{ $role->updated_at->format('M d, Y H:i') }}
                    </small>
                    <div class="action-buttons">
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit me-1"></i> Edit Role
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .detail-item {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }
    
    .detail-label {
        color: #6c757d;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    
    .detail-value {
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 0;
    }
    
    .section-title {
        color: #495057;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 0.5rem;
    }
    
    .group-title {
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }
    
    .permissions-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    
    .permission-badge {
        background-color: #e9ecef;
        padding: 0.5rem 0.75rem;
        border-radius: 4px;
        font-size: 0.875rem;
        display: inline-block;
        transition: all 0.2s;
    }
    
    .permission-badge:hover {
        background-color: #dee2e6;
        transform: translateY(-2px);
    }
    
    .permission-group {
        background-color: white;
        padding: 1rem;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .card-header {
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    
    .action-buttons .btn {
        min-width: 120px;
    }
</style>
@endsection
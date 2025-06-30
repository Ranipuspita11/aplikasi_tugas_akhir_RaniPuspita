@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-user text-primary me-2"></i>User Details</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>User Information</h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="detail-item">
                        <h6 class="detail-label">Name</h6>
                        <p class="detail-value">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <h6 class="detail-label">Email</h6>
                        <p class="detail-value">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <div class="roles-section">
                <h5 class="section-title mb-3"><i class="fas fa-user-tag me-2"></i>Assigned Roles</h5>
                @if (!empty($user->getRoleNames()))
                    <div class="roles-container">
                        @foreach ($user->getRoleNames() as $role)
                            <span class="role-badge">
                                {{ $role }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-circle me-1"></i> No roles assigned to this user
                    </div>
                @endif
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Last updated: {{ $user->updated_at->format('M d, Y H:i') }}
                </small>
                <div class="action-buttons">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit me-1"></i> Edit User
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

    .roles-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .role-badge {
        background-color: #e9ecef;
        padding: 0.5rem 0.75rem;
        border-radius: 4px;
        font-size: 0.875rem;
        display: inline-block;
        transition: all 0.2s;
    }

    .role-badge:hover {
        background-color: #dee2e6;
        transform: translateY(-2px);
    }

    .card-header {
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .action-buttons .btn {
        min-width: 120px;
    }
</style>
@endsection

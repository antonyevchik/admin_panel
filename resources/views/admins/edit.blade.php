@extends('adminlte::page')

@section('title', 'Edit Admin')

@section('content_header')
    <h1>Edit Admin</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Update Admin Details</h3>
        </div>
        <form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Password (leave blank to keep unchanged)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="online" {{ $admin->status == 'online' ? 'selected' : '' }}>Active</option>
                        <option value="offline" {{ $admin->status == 'offline' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admins.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

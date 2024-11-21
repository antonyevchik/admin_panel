@extends('adminlte::page')

@section('title', 'Admin Details')

@section('content_header')
    <h1>{{$admin->name}} Details</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">{{$admin->name}} Information</h3>
                @can('update', $admin)
                    <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @if($admin->avatar)
                <label for="avatar">Avatar</label>
                <div id="avatar-preview" style="margin-bottom: 10px;">
                    <img src="{{ Storage::url($admin->avatar) }}" alt="Avatar Preview" width="150" height="150" id="avatar-image">
                </div>
            @endif
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $admin->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $admin->email }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                            <span class="badge {{ $admin->status == 'online' ? 'badge-success' : 'badge-danger' }}">
                                {{ $admin->status == 'online' ? 'Active' : 'Inactive' }}
                            </span>
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $admin->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $admin->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('admins.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
@endsection

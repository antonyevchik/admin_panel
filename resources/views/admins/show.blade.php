@extends('adminlte::page')

@section('title', 'Admin Details')

@section('content_header')
    <h1>Admin Details</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Admin Information</h3>
        </div>
        <div class="card-body">
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

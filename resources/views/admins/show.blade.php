@extends('adminlte::page')

@section('title', 'Admin Details')

@section('content_header')
    <h1>@lang('adminlte::adminlte.admin_profile', ['name' => $admin->name])</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">@lang('adminlte::adminlte.admin_info', ['name' => $admin->name])</h3>
                @can('update', $admin)
                    <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @if($admin->avatar)
                <label for="avatar">@lang('adminlte::adminlte.avatar')</label>
                <div id="avatar-preview" style="margin-bottom: 10px;">
                    <img src="{{ Storage::url($admin->avatar) }}" alt="Avatar Preview" width="150" height="150" id="avatar-image">
                </div>
            @endif
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>@lang('adminlte::adminlte.name')</th>
                    <td>{{ $admin->name }}</td>
                </tr>
                <tr>
                    <th>@lang('adminlte::adminlte.email')</th>
                    <td>{{ $admin->email }}</td>
                </tr>
                <tr>
                    <th>@lang('adminlte::adminlte.status')</th>
                    <td>
                            <span class="badge {{ $admin->status == 'online' ? 'badge-success' : 'badge-danger' }}">
                                {{ $admin->status == 'online' ? __('adminlte::adminlte.online') : __('adminlte::adminlte.offline') }}
                            </span>
                    </td>
                </tr>
                <tr>
                    <th>@lang('adminlte::adminlte.created_at')</th>
                    <td>{{ $admin->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                <tr>
                    <th>@lang('adminlte::adminlte.updated_at')</th>
                    <td>{{ $admin->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('admins.index') }}" class="btn btn-primary">@lang('adminlte::adminlte.back')</a>
        </div>
    </div>
@endsection

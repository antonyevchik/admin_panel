@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('adminlte::adminlte.admins')</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-body table-responsive">
                    @if ($admins->isEmpty())
                        <p>No admins found.</p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>@lang('adminlte::adminlte.email')</th>
                                <th>@lang('adminlte::adminlte.name')</th>
                                <th>@lang('adminlte::adminlte.status')</th>
                                <th>@lang('adminlte::adminlte.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->status == 'online' ? __('adminlte::adminlte.online') : __('adminlte::adminlte.offline') }}</td>
                                        <td>
                                            <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admins.destroy', $admin->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop


@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('adminlte::adminlte.admins')</h1>
@stop

@section('content')
    <div class="row">
        <!-- Table -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@lang('adminlte::adminlte.email')</th>
                            <th>@lang('adminlte::adminlte.name')</th>
                            <th>@lang('adminlte::adminlte.status')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>john@example.com</td>
                            <td>John Doe</td>
                            <td><span class="badge badge-success">@lang('adminlte::adminlte.online')</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


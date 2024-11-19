@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <!-- Table -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Адміністратори</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>E-mail</th>
                            <th>Ім'я</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>john@example.com</td>
                            <td>John Doe</td>
                            <td><span class="badge badge-success">Активний</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop


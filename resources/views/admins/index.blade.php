@extends('app')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>@lang('adminlte::adminlte.admins')</h1>
        <a href="{{ route('admins.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i><span class="mx-2">Add</span>
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admins.index') }}" method="GET" class="form-inline">

                        <div class="form-group mx-sm-3 my-2">
                            <label for="email" class="sr-only">Email</label>
                            <input
                                type="text"
                                name="email"
                                id="email"
                                class="form-control"
                                placeholder="Search by Email"
                                value="{{ request('email') }}"
                            >
                        </div>

                        <div class="form-group mx-sm-3 my-2">
                            <label for="name" class="sr-only">Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                placeholder="Search by Name"
                                value="{{ request('name') }}"
                            >
                        </div>

                        <div class="form-group mx-sm-3 my-2">
                            <label for="status" class="sr-only">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">All Statuses</option>
                                <option value="online" {{ request('status') == 'online' ? 'selected' : '' }}>Active</option>
                                <option value="offline" {{ request('status') == 'offline' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary my-2 mx-2">Filter</button>

                        <a href="{{ route('admins.index') }}" class="btn btn-secondary my-2">Reset</a>
                    </form>
                </div>
            </div>

            <div class="box">
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
                                        <td>
                                            <div class="d-inline-flex">
                                                @if($admin->avatar)
                                                    <div id="avatar-preview" class="mb-2">
                                                        <img src="{{ Storage::url($admin->avatar) }}" alt="Avatar Preview" width="30" height="30" id="avatar-image">
                                                    </div>
                                                @endif
                                                <a href="{{ route('admins.show', $admin->id) }}" class="nav-link">
                                                    {{ $admin->name }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                             <span class="badge {{ $admin->status == 'online' ? 'badge-success' : 'badge-danger' }}">
                                                {{ $admin->status == 'online' ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            @can('update', $admin)
                                                <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete', $admin)
                                                <div id="delete" style="display:inline;">
                                                    <button  class="btn btn-danger btn-sm" onclick="deleteAdmin({{$admin->id}})">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            @endcan
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

<script>
    function deleteAdmin(itemId) {
        console.log(`admins/${itemId}`);
        axios.delete(`admins/${itemId}`)
            .then(response => {
                if (response.data.redirect_url) {
                    window.location.href = response.data.redirect_url;
                }
            })
            .catch(error => {
                console.error('Error deleting item:', error);
            });
    }
</script>

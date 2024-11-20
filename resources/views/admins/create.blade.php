@extends('adminlte::page')

@section('title', 'Create New Admin')

@section('content_header')
    <h1>@lang('adminlte::adminlte.create_new_admin')</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Enter name"
                        required>
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="Enter email"
                        required>
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter password"
                        required>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select
                        name="status"
                        id="status"
                        class="form-control @error('status') is-invalid @enderror"
                        required>
                        <option value="online" {{ old('status') == 'online' ? 'selected' : '' }}>Active</option>
                        <option value="offline" {{ old('status') == 'offline' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <div class="custom-file">
                        <input
                            type="file"
                            name="avatar"
                            id="avatar"
                            class="custom-file-input @error('avatar') is-invalid @enderror">
                        <label class="custom-file-label" for="avatar">Choose file</label>
                    </div>
                    @error('avatar')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

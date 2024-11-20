@extends('app')

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

{{--                <div class="form-group">--}}
{{--                    <label for="avatar">Avatar</label>--}}
{{--                    <div class="custom-file">--}}
{{--                        <input--}}
{{--                            type="file"--}}
{{--                            name="avatar"--}}
{{--                            id="avatar"--}}
{{--                            class="custom-file-input @error('avatar') is-invalid @enderror">--}}
{{--                        <label class="custom-file-label" for="avatar">Choose file</label>--}}
{{--                    </div>--}}
{{--                    @error('avatar')--}}
{{--                    <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                    @enderror--}}
{{--                </div>--}}

                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <div id="avatar-preview" style="margin-bottom: 10px;">
                        <img src="{{ asset('default-avatar.png') }}" alt="Avatar Preview" width="150" id="avatar-image">
                    </div>
                    <div class="input-group">
                        <input type="text" id="avatar-path" name="avatar" class="form-control" placeholder="Select avatar" readonly>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" id="upload-avatar-button">Upload</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
            <div id="upload-modal" style="display: none;">
                <form id="upload-avatar-form">
                    <input type="file" id="avatar-file" name="avatar" accept="image/*" required>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('upload-avatar-button').addEventListener('click', function () {
            document.getElementById('upload-modal').style.display = 'block';
        });

        document.getElementById('upload-avatar-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            axios.post('{{ route('admins.uploadAvatar') }}', formData)
                .then(response => {
                    if (response.data.status === 'success') {
                        document.getElementById('avatar-path').value = response.data.path;
                        document.getElementById('avatar-image').src = response.data.path;
                        document.getElementById('upload-modal').style.display = 'none';
                    } else {
                        alert(response.data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection

@extends('app')

@section('title', 'Create New Admin')

@section('content_header')
    <h1>@lang('adminlte::adminlte.create_new_admin')</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="avatar">@lang('adminlte::adminlte.avatar')</label>
                    <div id="avatar-preview" class="mb-2">
                        <img src="{{  asset('uploads/avatars/default-avatar.png') }}" alt="Avatar Preview" width="150" id="avatar-image">
                    </div>
                    <input type="text" id="avatar-path" name="avatar" style="display: none;" readonly>
                    <div  class="position-relative d-inline-flex justify-content-start">
                        <input type="file" id="avatar-file" class="custom-file-input" accept="image/*" required>
                        <label id="avatar-name" class="custom-file-label" for="customFile">@lang('adminlte::adminlte.choose_file')</label>
                    </div>
                    <button id="upload-button" class="btn btn-primary mt-1">@lang('adminlte::adminlte.attach')</button>
                </div>

                <div class="form-group">
                    <label for="name">@lang('adminlte::adminlte.name')</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="@lang('adminlte::adminlte.enter_name')"
                        required>
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">@lang('adminlte::adminlte.email')</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="@lang('adminlte::adminlte.enter_email')"
                        required>
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">@lang('adminlte::adminlte.password')</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="@lang('adminlte::adminlte.enter_password')"
                        required>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">@lang('adminlte::adminlte.status')</label>
                    <select
                        name="status"
                        id="status"
                        class="form-control @error('status') is-invalid @enderror"
                        required>
                        <option value="online" {{ old('status') == 'online' ? 'selected' : '' }}>@lang('adminlte::adminlte.online')</option>
                        <option value="offline" {{ old('status') == 'offline' ? 'selected' : '' }}>@lang('adminlte::adminlte.offline')</option>
                    </select>
                    @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"> @lang('adminlte::adminlte.create')</button>
                <a href="{{ route('admins.index') }}" class="btn btn-secondary"> @lang('adminlte::adminlte.cancel')</a>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('avatar-file').addEventListener('change', function (event) {
            document.getElementById('upload-button').style.display = 'inline';
            const fileName = event.target.files[0]?.name || 'Choose file';
            const label = document.getElementById('avatar-name');
            label.textContent = fileName;
        });

        document.getElementById('upload-button').addEventListener('click', function (e) {
            e.preventDefault();

            const fileInput = document.getElementById('avatar-file');
            const files = fileInput.files;

            const formData = new FormData();
            formData.append('avatar', files[0]);

            axios.post('{{ route('admins.uploadAvatar') }}', formData)
                .then(response => {
                    if (response.data.status === 'success') {
                        document.getElementById('avatar-path').value = response.data.filename;
                        document.getElementById('avatar-image').src = response.data.path;
                        document.getElementById('upload-button').style.display = 'none';
                    } else {
                        alert(response.data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection

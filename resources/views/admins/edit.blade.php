@extends('app')

@section('title', 'Edit Admin')

@section('content_header')
    <h1>Edit {{$admin->name}} profile</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Update {{$admin->name}} Details</h3>
        </div>
        <form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <div id="avatar-preview"  class="mb-2">
                        <img src="{{ Storage::url($admin->avatar) ?? asset('uploads/avatars/default-avatar.png') }}" alt="Avatar Preview" width="150" id="avatar-image">
                    </div>
                    <input type="text" id="avatar-path" name="avatar" style="display: none;" readonly>
                    <div  class="position-relative d-inline-flex justify-content-start">
                        <input type="file" id="avatar-file" class="custom-file-input" accept="image/*" required>
                        <label id="avatar-name" class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <button id="upload-button" class="btn btn-primary mt-1">Upload</button>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $admin->name) }}"
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
                        value="{{ old('email', $admin->email) }}"
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
                        <option value="online" {{ old('status', $admin->status) == 'online' ? 'selected' : '' }}>Active</option>
                        <option value="offline" {{ old('status', $admin->status) == 'offline' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admins.index') }}" class="btn btn-secondary">Cancel</a>
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
                        console.log(response.data.path)
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

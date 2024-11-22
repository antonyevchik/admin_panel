@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_body')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="@lang('adminlte::adminlte.email')" value="{{ old('email') }}" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
            <span class="text-red text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="@lang('adminlte::adminlte.password')" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="text-red text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">
                        @lang('adminlte::adminlte.remember_me')
                    </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">@lang('adminlte::adminlte.sign_in')</button>
            </div>
        </div>
    </form>
@endsection


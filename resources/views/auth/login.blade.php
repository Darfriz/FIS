@extends('layouts.app')

@section('content')
<script>
    // Check if the user is already logged in
    @auth
        window.location.href = "{{ route('welcome') }}"; // Redirect to the dashboard or another page
    @endauth
</script>

<div class="container-fluid p-0" style="background-image: url('{{ asset('images/mountain.jpg') }}'); background-size: cover; height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-8"> <br><br><br>
            <div class="card shadow w-50 mx-auto custom-background">
                <div class="card-header text-center bg-primary text-white">
                    <h2>{{ __('Login') }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                        </div>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .custom-background {
        background-color: rgba(255, 255, 255, 0.5); /* Adjust the alpha channel (last value) for transparency */
    }
</style>
@endsection
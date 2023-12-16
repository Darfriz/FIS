@extends('layouts.app')

@section('content')
<div class="container-fluid p-0" style="background-image: url('{{ asset('images/brown_mountains.jpg') }}'); background-size: cover; height: 100vh;">
    <div class="row justify-content-center"> 
        <div class="col-md-8"> <br><br><br>
        <div class="card shadow w-50 mx-auto custom-background">
        <div class="card-header text-center bg-primary text-white"> 
            <h2>{{ __('Register') }}</h2>
            </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>

                           
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

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

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            
                        </div>

                        <div class="mb-3 text-center custom-orange-background">
                            <button type="submit" class="btn btn-primary w-100">{{ __('Register') }}</button>
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

    .custom-orange-background {
        background-color: #FF6C00;
    }
</style>
@endsection

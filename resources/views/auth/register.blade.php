@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" onsubmit="return checkPassword()">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback password-error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">

                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                    <span class="invalid-feedback password-error" role="alert"></span>
                                    {{-- <input id="show-password-checkbox" type="checkbox"> Show password --}}
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function checkPassword() {
            const password = document.getElementById("password").value;
            const confirm_password = document.getElementById("password-confirm").value;

            if (password !== confirm_password) {
                const errorMessage = "Passwords do not match.";
                const errorElement = document.querySelector('.password-error');
                errorElement.innerHTML = '<strong>' + errorMessage + '</strong>';
                errorElement.style.display = 'block';
                return false;
            } else {
                const errorElement = document.querySelector('.password-error');
                errorElement.style.display = 'none';
                return true;
            }
        }
        // const passwordInput = document.getElementById("password");
        // const showPasswordCheckbox = document.getElementById("show-password-checkbox");

        // showPasswordCheckbox.addEventListener("change", function() {
        //     if (passwordInput.type === "password") {
        //         passwordInput.type = "text";
        //         console.log(passwordInput.type);
        //     } else {
        //         passwordInput.type = "password";
        //         console.log(passwordInput.type);
        //     }
        // });
    </script>
@endsection

@section('css')
    <style>
        /* sovrascrivi lo stile predefinito dell'input di tipo password */
        /* input[type="password"] {
                                                                                                    -webkit-text-security: none; */
        /* per browser WebKit come Chrome e Safari */
        /* text-security: none; */
        /* per browser che supportano questa proprietà */
        /* } */
    </style>
@endsection

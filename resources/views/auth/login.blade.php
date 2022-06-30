@extends("backend.layouts.master")

@section("page-css")

@endsection

@section("content")
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left" style="background-color: #bbe8ff4a;">
                    <img class="img-fluid" src="{{ setting('settings.general_settings.app_logo') }}" alt="Logo">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Login</h1>
                        @if (session('status'))
                            <p class="text-green-600">
                                {{ session('status') }}
                            </p>
                        @endif

                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="password" type="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Login</button>
                            </div>
                        </form>
                        <!-- /Form -->

                        <div class="text-center forgotpass">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("page-script")

@endsection

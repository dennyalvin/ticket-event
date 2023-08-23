@extends('base_layout')

@section('main')
    <main class="form-signin w-100 m-auto">
        <div>
            <h2 class="h3 mb-3 fw-normal">Login</h2>
        </div>
        <div class="card mb-4 rounded-3 shadow-sm">
            @if (session()->has('status'))
                <div class="card-header alert alert-success">
                    {{ session('status') }}
                </div>
            @elseif ($errors->all())
                <div class="card-header alert alert-danger center">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="card-body">
                <form method="POST" action="{{ Route('login.action') }}">
                    {{ csrf_field() }}

                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="name@example.com" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                    </div>

                    <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
                </form>
                <div class="text-end mb-3 mt-1">
                    <span>Don't have account? </span>
                    <span>
                        <a href="{{ Route('register') }}" class="font-500 font-14 font-secondary text-primary">Register Now</a>
                    </span>
                </div>

                <div class="row mt-3">
                    <span class="col border-bottom"></span>
                    <span class="col text-center">
                        or Continue with
                    </span>
                    <span class="col border-bottom"></span>

                </div>
                <div class="row mt-3">
                    <a href="{{ route('auth.google') }}" class="col btn btn-secondary py-2 m-3">
                        <span>
                            <img width="25" src="https://user-images.githubusercontent.com/1770056/58111071-c2941c80-7bbe-11e9-8cac-1c3202dffb26.png"></span>
                        Google
                    </a>
                    <a href="{{ route('auth.facebook') }}"class="col btn btn-primary py-2 m-3" type="submit">
                        <span>
                            <img width="25" src="https://w7.pngwing.com/pngs/253/503/png-transparent-facebook-computer-icons-social-networking-service-login-facebook-icon-angle-text-logo.png" />
                        </span>
                        Facebook
                    </a>
                </div>
            </div>
        </div>


    </main>

@endsection

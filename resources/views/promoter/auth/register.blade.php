@extends('base_layout')

@section('main')
    <main class="form-signin w-100 m-auto">
        <div>
            <h3 class="h4 mb-3">Lets be a part of us by Register as Promoter!</h3>
        </div>
        <div class="card mb-4 rounded-3 shadow-sm">
            @if (!empty($errors->all()))
                <div class="card-header alert alert-danger center">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="card-body">
                <form method="POST" action="{{ Route('promoter.register.action') }}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="firstNameInput" class="form-label">Company name</label>
                        <input class="form-control" id="firstNameInput" name="company_name">
                    </div>

                    <div class="mb-3 fs-6 mt-5 text-center">
                        For Login Account
                    </div>
                    <div class="mb-3">
                        <label for="firstNameInput" class="form-label">First name</label>
                        <input class="form-control" id="firstNameInput" name="first_name">
                    </div>

                    <div class="mb-3">
                        <label for="inputLastName" class="form-label">Last name</label>
                        <input class="form-control" id="inputLastName" name="last_name">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputPhone">62</span>
                        <input type="text" class="form-control" placeholder="81xxx" name="phone">
                    </div>

                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="name@example.com" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                    </div>

                    <button class="btn btn-primary w-100 py-2" type="submit">Create you account</button>
                </form>
                <div class="text-end mb-3 mt-1">
                    <span>Already have account? </span>
                    <span>
                        <a href="{{ Route('login') }}" class="font-500 font-14 font-secondary text-primary">Login</a>
                    </span>
                </div>

                <div class="row mt-3">
                    <span class="col border-bottom"></span>
                    <span class="col text-center">
                        or continue with
                    </span>
                    <span class="col border-bottom"></span>

                </div>

            </div>
        </div>


    </main>

@endsection

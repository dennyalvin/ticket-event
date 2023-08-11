<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticketing Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/styles.css') }}"/>

</head>
<body class="d-flex bg-body-tertiary">
<main class="w-100 ">
    <header class="p-3 mb-3 border-bottom border-primary-subtle border-4">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('event.list') }}" class="nav-link px-2 link-secondary">Home</a></li>

                    @if(!empty(Session::get('user_id')))
                        <li><a href="{{ route('order.list') }}" class="nav-link px-2 link-secondary">My Orders</a></li>
                    @else
                        <li>
                            <a class="nav-link px-2 link-dark fw-bold" href="{{ route('promoter.register') }}">Be part of us, be an Event Promoter</a>
                        </li>
                    @endif

                    @if(!empty(Session::get('promoter')) && Session::get('promoter') == 1)

                        <li class="ms-5">
                            <a href="{{ route('promoter.event.create') }}" class="nav-link px-2 link-secondary">+ Create new
                                event</a>
                        </li>
                        <li>
                            <a href="{{ route('promoter.event.list') }}" class="nav-link px-2 link-secondary">My Events</a>
                        </li>
                        <li>
                            <a href="{{ route('promoter.balance') }}" class="nav-link px-2 link-secondary">My Balance</a>
                        </li>

                    @endif
                </ul>

                <span class="text-end mx-3">
                    @if(!empty(Session::get('first_name')))
                        {{ "Hi ".Session::get('first_name') }},
                    @endif
                </span>

                <span class="text-end mx-3">
                    @if(!empty(Session::get('user_id')))
                        <a href="{{ route('logout') }}">logout</a>
                    @else
                        Already have account? <a href="{{ route('login') }}">login</a> or
                        <a href="{{ route('register') }}">register now</a>
                    @endif
                </span>
            </div>
        </div>
    </header>
    <div class="b-example-divider"></div>

    @yield('main')

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Ticketing Event Company, Inc</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-body-secondary" href="#">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="#twitter"></use>
                        </svg>
                    </a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="#instagram"></use>
                        </svg>
                    </a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="#facebook"></use>
                        </svg>
                    </a></li>
            </ul>
        </footer>
    </div>
</main>
</body>
</html>

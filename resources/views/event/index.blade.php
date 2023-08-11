@extends('base_layout')

@section('main')

        <div class="container">
            <div class="row">
                @if (session()->has('success_message'))
                    <div class="card-header alert alert-success">
                        {{ session('success_message') }}
                    </div>
                @endif
                <div class="col-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">Event Types</p>
                            <div class="justify-content-between align-items-center">
                                <div class="row mb-3 offset-1">
                                    <a href="{{ route('event.list') }}"
                                       class="col focus-ring py-1 px-2 text-decoration-none link-underline-primary link-opacity-50-hover">
                                        All
                                    </a>
                                </div>
                                @foreach($event_types as $type)
                                    <div class="row mb-3 offset-1">
                                        <a href="{{ route('event.list',['type' => $type->code]) }}"
                                           class="col focus-ring py-1 px-2 text-decoration-none link-underline-primary link-opacity-50-hover">
                                            {{ $type->name }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="row">
                        @foreach($events as $event)
                            <div class="col-4 mb-3">
                                <a class="card shadow-sm text-decoration-none" href="{{ route('event.detail',['slug' => $event->slug]) }}">

                                    <img class="bd-placeholder-img card-img-top" fill="#55595c" height="225" src="{{ $event->banner }}"/>

                                    <div class="card-body">
                                        <p class="card-text fw-bold text-truncate">{{ $event->title }}</p>
                                        <div class="d-flex justify-content-between align-items-center float-end">

                                            <small class="text-primary">IDR {{ $event->cheapest->priceFormatted }}</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>


@endsection

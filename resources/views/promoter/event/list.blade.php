@extends('base_layout')

@section('main')
    <div class="container">
        @if (session()->has('errors'))
            <div class="card-header alert alert-danger">
                {{ session('errors') }}
            </div>
        @endif
        <div class="col">
            <div class="row card shadow-sm mb-5">
                <div class="card-body">
                    <h4 class="card-text">My Events</h4>
                    <div class="justify-content-between align-items-center">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Type</th>
                                <th scope="col">Location</th>
                                <th scope="col">Status</th>
                                <th scope="col">start price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td class="text-truncated"><a href="{{ route('promoter.event.detail',['encoded_id' => base64_encode($event->id)]) }}">
                                            {{ $event->title }}
                                        </a>
                                    </td>
                                    <td>{{ $event->event_type_code }}</td>
                                    <td class="text-truncated">{{ $event->location_address }}</td>
                                    <td>{{ $event->status }}</td>
                                    <td class="text-end">{{ $event->packages()->first()->price_formatted }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>


    </div>

@endsection

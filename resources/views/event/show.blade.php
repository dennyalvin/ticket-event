@extends('base_layout')

@section('main')
        <div class="container">
            <div class="row">
                <div class="row">
                    <img src="{{ $event->banner }}" height="255">
                </div>
            </div>

            <div class="row mt-3">

                <div class="col-8">
                    <div class="row card shadow-sm mb-5">
                        <div class="card-body">
                            <h4 class="card-text">Description</h4>
                            <div class="justify-content-between align-items-center">
                                {{ $event->description }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <h2>Packages</h2>
                    </div>
                    @foreach($event->packages as $package)
                        <div class="row card shadow-sm mb-3">
                            <div class="card-body">
                                <span class="card-text">{{ $package->name }}</span>
                                <div class="justify-content-between text-end fw-bold text-danger">
                                    IDR {{ $package->priceFormatted }}
                                </div>
                                <div>
                                    <a href="{{ route('order.chart',['slug' => $event->slug, 'package_id' => $package->id]) }}"
                                       class="float-end btn btn-primary col-2 py-2" type="submit">Select</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row card shadow-sm mb-3">
                        <div class="card-body">
                            <h4 class="card-text">Redemption</h4>
                            <div class="justify-content-between align-items-center">
                                {{ $event->redemption }}
                            </div>
                        </div>
                    </div>

                    <div class="row card shadow-sm mb-3">
                        <div class="card-body">
                            <h4 class="card-text">Terms and conditions</h4>
                            <div class="justify-content-between align-items-center">
                                {{ $event->term_condition }}
                            </div>
                        </div>
                    </div>

                    <div class="row card shadow-sm mb-3">
                        <div class="card-body">
                            <h4 class="card-text">Additional Information</h4>
                            <div class="justify-content-between align-items-center">
                                {{ $event->additional_information }}
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="justify-content-between align-items-center">
                                <span class="fw-bolder">Event Date</span> : {{ $event->date_formated }}
                            </div>

                            <div class="justify-content-between align-items-center">
                                <span class="fw-bolder">Location</span> : {{ $event->location_address }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

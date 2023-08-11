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
                    <h4 class="card-text">Order Details</h4>
                    <div class="justify-content-between align-items-center">
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="firstNameInput" class="form-label fw-bold">Invoice : </label>
                                {{ $order->invoice_no }}
                            </div>

                            <div class="col">
                                <label for="inputLastName" class="form-label fw-bold">Create Date : </label>
                                {{ $order->created_at_formatted }}
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col text-truncate">
                                <label for="firstNameInput" class="form-label fw-bold">Event : </label>
                                <a target="_blank" href="{{ route('event.detail',['slug' => $order->event_slug]) }}">
                                    {{ $order->event_title }}
                                </a>
                            </div>

                            <div class="col text-truncate">
                                <label for="inputLastName" class="form-label fw-bold">Package Name : </label>
                                {{ $order->event_selected_package_name }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="inputPhone" class="form-label fw-bold">Price : </label>
                                <span class="float-end">IDR {{ $order->price_formatted }}</span>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="inputEmail" class="form-label fw-bold">Total Tax : </label>
                                <span class="float-end">IDR {{ $order->tax_formatted }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="inputPhone" class="form-label fw-bold">Total Amount : </label>
                                <span class="float-end fw-bold">IDR {{ $order->total_amount_formatted }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row card shadow-sm mb-5">
                <div class="card-body">
                    <h4 class="card-text">Personal Information</h4>
                    <div class="justify-content-between align-items-center">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->information as $info)
                                <tr>
                                    <td>{{ $info->first_name }}</td>
                                    <td>{{ $info->last_name }}</td>
                                    <td>{{ $info->phone }}</td>
                                    <td>{{ $info->email }}</td>
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

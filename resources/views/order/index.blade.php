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
                    <h4 class="card-text">Transaction List</h4>
                    <div class="justify-content-between align-items-center">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Invoice</th>
                                <th scope="col">Title</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{ route('order.detail',['encoded_invoice' => base64_encode($order->invoice_no)]) }}">
                                            {{ $order->invoice_no }}
                                        </a>
                                    </td>
                                    <td>{{ $order->event_title }}</td>
                                    <td class="text-end">{{ $order->total_amount_formatted }}</td>
                                    <td>{{ $order->created_at_formatted }}</td>
                                    <td>{{ $order->status }}</td>
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

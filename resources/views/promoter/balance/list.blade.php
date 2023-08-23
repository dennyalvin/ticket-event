@extends('base_layout')

@section('main')
    <div class="container">
        @if (session()->has('success_message'))
            <div class="card-header alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif
    
        @if (session()->has('errors'))
            <div class="card-header alert alert-danger">
                {{ session('errors') }}
            </div>
        @endif
        <div class="col">
            <div class="row card shadow-sm mb-5">
                <div class="card-body">
                    <h4 class="card-text">My Balance</h4>
                    <div class="justify-content-between align-items-center">
                        <a class="btn btn-sm btn-success py-2 col-2" href="{{ route('promoter.balance.withdraw') }}">Withdraw</a>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Doc No</th>
                                <th scope="col">Transaction</th>
                                <th scope="col">debit</th>
                                <th scope="col">credit</th>
                                <th scope="col">balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $balance = 0;
                            @endphp

                            @foreach($balances as $b)
                                @php
                                    $balance = $balance + ($b->debit - $b->credit);
                                @endphp
                                <tr>
                                    <td>{{ $b->created_at_formatted }}</td>
                                    <td>{{ $b->doc_no }}</td>
                                    <td>{{ $b->transaction_type }}</td>
                                    <td class="text-end">{{ $b->debit > 0 ? $b->debit_formatted : '-' }}</td>
                                    <td class="text-end">{{ $b->credit > 0 ? $b->credit_formatted : '-' }}</td>
                                    <td class="text-end">{{ number_format($balance,0) }}</td>
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

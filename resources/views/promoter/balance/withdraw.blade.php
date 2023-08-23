@extends('base_layout')

@section('main')
    <main class="form-signin w-100 m-auto">
        <div>
            <h2 class="h3 mb-3 fw-normal">Withdraw Balance</h2>
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
                <form method="POST" action="{{ Route('promoter.balance.withdraw.action') }}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <span id="inputAMountInline" class="form-text">
                          Total Balance : IDR {{ number_format($total_balance,0) }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="inputAmount" class="form-label">Withdraw Amount</label>
                        <input type="text" class="form-control" id="inputEmail"
                               name="amount">
                    </div>

                    <button class="btn btn-primary w-100 py-2" type="submit">Submit</button>
                </form>
            </div>
        </div>


    </main>

@endsection

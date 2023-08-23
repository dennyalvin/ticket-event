@extends('base_layout')

@section('main')
    <div class="container">
        @if (session()->has('errors'))
            <div class="card-header alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form class="row" method="POST"
              action="{{ Route('order.chart.action', ['slug' => $event->slug, 'package_id' => $event->packages->first->id]) }}">
            <div class="col-8">
                <div class="row card shadow-sm mb-5">
                    <div class="card-body">
                        <h4 class="card-text">Personal Information</h4>
                        <div class="justify-content-between align-items-center">
                            {{ csrf_field() }}
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="firstNameInput" class="form-label">First name</label>
                                    <input class="form-control" id="firstNameInput" name="first_name"
                                           value="{{ $user ? $user->first_name : null }}"/>
                                </div>

                                <div class="col">
                                    <label for="inputLastName" class="form-label">Last name</label>
                                    <input class="form-control" id="inputLastName" name="last_name"
                                           value="{{ $user ? $user->last_name : null }}"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="inputPhone" class="form-label">Phone</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputPhone">62</span>
                                        <input type="text" class="form-control" placeholder="81xxx" name="phone"
                                               value="{{ str_replace('62','',$user ? $user->phone : '') }}"/>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="inputEmail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="inputEmail"
                                           placeholder="name@example.com" name="email"
                                           value="{{ $user ? $user->email : null}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row card shadow-sm mb-5">
                    <input type="hidden" name="payment_method" value="credit_card"/>
                    <div class="card-body">
                        <h4 class="card-text">Payment Method</h4>
                        <div class="justify-content-between align-items-center">
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="inputCCNo" class="form-label">Credit Card No</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="inputCCNo" name="cc_no"
                                               value="123456">
                                        <span class="input-group-text" id="basic-addon2">
                                                <img width="50"
                                                     src="https://e7.pngegg.com/pngimages/678/81/png-clipart-visa-and-master-cards-mastercard-money-foothills-florist-business-visa-visa-mastercard-text-service.png"/>
                                            </span>
                                    </div>
                                </div>


                                <div class="col">
                                    <label for="inputCCName" class="form-label">Name</label>
                                    <input class="form-control" id="inputCCName" name="cc_name"
                                           value="{{ $user ? $user->first_name : null }}"/>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="inputCCExp" class="form-label">Expired</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Month(MM)</span>
                                        <input type="text" maxlength="2" class="form-control" placeholder="MM"
                                               name="cc_exp_month" value="08"/>
                                        <span class="input-group-text">Year(YY)</span>
                                        <input type="text" maxlength="2" class="form-control" placeholder="YY"
                                               name="cc_exp_year" value="29"/>
                                    </div>
                                </div>


                                <div class="col">
                                    <label for="inputCCCVV" class="form-label">CVC/CVV</label>
                                    <input class="form-control" id="inputCCCVV" name="cc_cvc" value="123" maxlength="3">
                                </div>
                            </div>

                            @if(!empty(Session::get('user_id')))
                                <button class="btn btn-primary w-100 py-2" type="submit">Proceed Payment</button>
                            @else
                                <div class="alert alert-warning">
                                To make an order, you have to <a href="{{ route('login') }}">login</a> , don't have account ?
                                <a href="{{ route('register') }}">register now</a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center row">
                            <img src="{{ $event->banner }}" height="200"/>
                        </div>

                        <div class="justify-content-between align-items-center mb-2">
                            <span class="fw-bolder">Event</span> : {{ $event->title }}
                        </div>

                        <div class="justify-content-between align-items-center mb-2">
                            <span class="fw-bolder">Event Date</span> : {{ $event->date_formated }}
                        </div>

                        <div class="justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <span class="fw-bolder">Location</span> : {{ $event->location_address }}
                        </div>

                        <div class="justify-content-between align-items-center mb-3 ">
                            <span class="fw-bolder">Selected package</span> : {{ $event->packages->first()->name }}
                        </div>

                        <div class="justify-content-between align-items-center">
                            <span class="fw-bolder">Price</span>
                            <span class="float-end">
                                    {{ $event->packages->first()->priceFormatted }}
                                </span>

                        </div>

                        <div class="justify-content-between align-items-center">
                            <span class="fw-bolder">Tax</span>
                            <span class="float-end">
                                    {{ $event->packages->first()->taxFormatted }}
                                </span>
                        </div>

                        <div class="justify-content-between align-items-center">
                            <span class="fw-bolder">Total Payment</span>
                            <span class="float-end">
                                    {{ $event->packages->first()->totalAmountFormatted }}
                                </span>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

@endsection

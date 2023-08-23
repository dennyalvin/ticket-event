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
              action="{{ Route('promoter.event.create.action') }}">
            <div class="col">
                <div class="row card shadow-sm mb-5">
                    <div class="card-body">
                        <h4 class="card-text">Create a new event</h4>
                        <div class="justify-content-between align-items-center">
                            {{ csrf_field() }}
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="firstNameInput" class="form-label">Title</label>
                                    <input class="form-control" id="firstNameInput" name="title"/>
                                </div>

                                <div class="col">
                                    <label for="inputPhone" class="form-label">Type</label>
                                    <select name="event_type_code" class="form-select"
                                            aria-label="Default select example">
                                        <option selected>Select</option>
                                        @foreach($event_types as $t)
                                            <option value="{{ $t->code }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="inputPhone" class="form-label">Description</label>
                                    <textarea class="form-control" id="firstNameInput" name="description"></textarea>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="inputPhone" class="form-label">Location Address</label>
                                    <textarea class="form-control" id="firstNameInput"
                                              name="location_address"></textarea>
                                </div>

                                <div class="col">
                                    <label for="inputPhone" class="form-label">Redemption Description</label>
                                    <textarea class="form-control" id="firstNameInput"
                                              name="redemption_desc"></textarea>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="inputPhone" class="form-label">Terms and Conditions</label>
                                    <textarea class="form-control" id="firstNameInput" name="term_condition"></textarea>
                                </div>

                                <div class="col">
                                    <label for="inputPhone" class="form-label">Additional Information</label>
                                    <textarea class="form-control" id="firstNameInput"
                                              name="additional_information"></textarea>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="inputPhone" class="form-label">Date</label>
                                    <input class="form-control" id="firstNameInput" name="date_on"/>
                                </div>

                                <div class="col">
                                    <label for="inputPhone" class="form-label">Status</label>
                                    <select name="status" class="form-select" aria-label="Default select example">
                                        <option selected>Select</option>
                                        <option value="published">Publish</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="row card shadow-sm mb-5">
                    <div class="card-body">
                        <h4 class="card-text">Packages</h4>
                        <div class="justify-content-between align-items-center">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Quota</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>
                                            <input class="form-control" id="firstNameInput" name="package_name[]"/>
                                        </td>
                                        <td>
                                            <input class="form-control" id="firstNameInput" name="package_quota[]"/>
                                        </td>
                                        <td>
                                            <input class="form-control" id="firstNameInput" name="package_price[]" value="0"/>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <button class="btn btn-primary w-100 py-2 float-end" type="submit">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>


            </div>


        </form>
    </div>

@endsection

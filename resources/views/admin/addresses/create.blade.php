@extends('layouts.admin')

@section('content')
    <section class="content mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Address</h3>
                        </div>
                        <div class="card-body">
                            @include('partials.validation_errors')
                            <form action="{{ route('addresses.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select id="user_id" name="user_id" class="form-control custom-select">
                                        <option selected="" disabled="">Select one</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{ $user->id == old('user_id') ? 'selected' : '' }}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="area_id">Area</label>
                                    <select id="area_id" name="area_id" class="form-control custom-select">
                                        <option selected="" disabled="">Select one</option>
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}" {{ $area->id == old('area_id') ? 'selected' : '' }}>{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="street_name">Street Name</label>
                                    <input type="text" id="street_name" name="street_name" value="{{ old('street_name') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="building_number">Building No.</label>
                                    <input type="number" id="building_number" name="building_number" value="{{ old('building_number') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="floor_number">Floor No.</label>
                                    <input type="number" id="floor_number" name="floor_number" value="{{ old('floor_number') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="flat_number">Flat No.</label>
                                    <input type="number" id="flat_number" name="flat_number" value="{{ old('flat_number') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="is_main">Main Address</label>
                                    <select id="is_main" name="is_main" class="form-control custom-select">
                                        <option value='0' {{ 0 == old('is_main') ? 'selected' : '' }}>No</option>
                                        <option value='1' {{ 1 == old('is_main') ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <input type="submit" value="Add New Address" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
@endsection

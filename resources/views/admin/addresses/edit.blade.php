@extends('layouts.admin')

@section('content')
    <section class="content mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Address</h3>
                    </div>
                    <div class="card-body">
                        @include('partials.validation_errors')
                        <form action="{{ route('addresses.update', $address->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select id="user_id" name="user_id" class="form-control custom-select">
                                    <option selected="" disabled="">Select one</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}"
                                            {{ $user->id == $address->user_id ? 'selected' : ($user->id == old('user_id') ? 'selected' : '') }}>
                                            {{$user->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="area_id">Area</label>
                                <select id="area_id" name="area_id" class="form-control custom-select">
                                    <option selected="" disabled="">Select one</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->id}}"
                                            {{ $area->id == $address->area_id ? 'selected' : ($area->id == old('area_id') ? 'selected' : '') }}>
                                            {{$area->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="street_name">Street Name</label>
                                <input type="text" id="street_name" name="street_name" value="{{ old('street_name') ? old('street_name') : $address->street_name }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="building_number">Building No.</label>
                                <input type="number" id="building_number" name="building_number" value="{{ old('building_number') ? old('building_number') : $address->building_number }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="floor_number">Floor No.</label>
                                <input type="number" id="floor_number" name="floor_number" value="{{ old('floor_number') ? old('floor_number') : $address->floor_number }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="flat_number">Flat No.</label>
                                <input type="number" id="flat_number" name="flat_number" value="{{ old('flat_number') ? old('flat_number') : $address->flat_number }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="is_main">Main Address</label>
                                <select id="is_main" name="is_main" class="form-control custom-select">
                                    <option value='0'
                                        {{ '0' == $address->is_main ? 'selected' : '' }}>
                                        No
                                    </option>
                                    <option value='1'
                                        {{ '1' == $address->is_main ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                </select>
                            </div>
                            <input type="submit" value="Edit Address" class="btn btn-success">
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

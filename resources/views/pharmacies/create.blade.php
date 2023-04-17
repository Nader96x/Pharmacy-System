@extends('layouts.admin')

@section('content')
    <section class="content mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">New Pharmacy</h3>
                    </div>
                    <div class="card-body">
{{--                        @include('partials.validation_errors')--}}
                        <form action="{{ route('pharmacies.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Avatar</label>
                                <input type="text" id="avatar" name="avatar" min="1"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name">Priority</label>
                                <input type="number" id="priority" name="priority" min="1"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="area_id">Aria_id</label>
                                <select id="area_id" name="area_id" class="form-control">
                                    <option selected="" disabled="">Select Pharmacy's Area</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button role="button" value="Add" class="btn btn-success">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

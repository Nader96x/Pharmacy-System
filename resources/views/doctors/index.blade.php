@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Doctors</h1>
                <a href="{{ route('doctors.create') }}" class="btn btn-primary">Add Doctor</a>
                <hr>
                @include('partials.flash-message')
                <table class="table">
                    <thead>
                    <tr>
                        <th>National ID</th>
                        <th>Avatar Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        {{--                        <th>Password</th>--}}
                        <th>Created At</th>
                        <th>Is Banned</th>
                        <th>Ban</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->national_id }}</td>
                            <td><img src="{{ $doctor->image }}" width="50" height="50" alt="Avatar"></td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            {{--                            <td>{{ $doctor->password }}</td>--}}
                            <td>{{ $doctor->created_at }}</td>
                            <td>{{ $doctor->is_banned }}</td>
                            <td>
                                @if($doctor->is_banned)
                                    <form method="POST" action="{{ route('doctors.unban', $doctor->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">{{ __('Unban') }}</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('doctors.ban', $doctor->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-secondary">{{ __('Ban') }}</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST"
                                      style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure to delete this record ?')">Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $doctors->links() }}
            </div>
        </div>
    </div>
@endsection

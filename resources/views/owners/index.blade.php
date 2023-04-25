@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Owners</h1>
                <a href="{{ route('owners.create') }}" class="btn btn-primary">Add Owner</a>
                <hr>
                <table class="table">
                    <thead>
                    <tr>
                        <th>National ID</th>
                        <th>Avatar Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        {{--                        <th>Password</th>--}}
                        <th>Created At</th>
                        <th>Is Banned </th>
                        <th>Ban</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($owners as $owner)
                        <tr>
                            <td>{{ $owner->national_id }}</td>
                            <td><img src="{{ $owner->image }}" width="50" height="50" alt="Avatar"></td>
                            <td>{{ $owner->name }}</td>
                            <td>{{ $owner->email }}</td>
                            {{--                            <td>{{ $doctor->password }}</td>--}}
                            <td>{{ $owner->created_at }}</td>
                            <td>{{ $owner->is_banned }}</td>
                            <td>
                                @if($owner->is_banned)
                                    <form method="POST" action="{{ route('owners.unban', $owner->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">{{ __('Unban') }}</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('owners.ban', $owner->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-secondary">{{ __('Ban') }}</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('owners.edit', $owner->id) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('owners.destroy', $owner->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record ?')" >Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $owners->links() }}
            </div>
        </div>
    </div>
@endsection

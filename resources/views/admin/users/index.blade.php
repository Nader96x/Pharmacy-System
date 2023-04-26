@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('partials.flash-message')
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                 Name
                            </th>
                            <th>
                                 Email
                            </th>
                            <th>
                               Gender
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Birth date
                            </th>

                            <th>
                                National id
                            </th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->birth_date }}</td>
                                <td>{{ $user->national_id }}</td>
                                <td>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-2 w-100">
                        {{ $users->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection



@section('scripts')
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script type="text/javascript">

        $('.show_confirm').click(function(event) {
            let form =  $(this).closest("form");
            let name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>

@endsection

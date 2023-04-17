@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Medicines</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" href="{{route('medicines.index')}}">Medicines</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @include('partials.flash-message')
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-primary btn-sm" href="{{ route('medicines.create') }}">
                        <i class="fas fa-plus">
                        </i>
                        New Medicine
                    </a>
                </h3>

            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 30%">
                            Medicine Name
                        </th>
                        <th style="width: 20%">
                            Price ($)
                        </th>
                        <th>
                            Cost ($)
                        </th>

                        <th style="width: 30%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($medicines as $medicine)
                        <tr>
                            <td>
                                {{$medicine['id']}}
                            </td>
                            <td>
                                {{$medicine['name']}}
                            </td>
                            <td>
                                {{$medicine['price']}}
                            </td>
                            <td>
                                {{$medicine['cost']}}
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="{{route('medicines.show',$medicine['id'])}}">
                                    <i class="fas fa-eye">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{route('medicines.edit',$medicine['id'])}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>

                                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm swal-delete"
                                            data-id="{{ $medicine->id }}">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-center">
                    {{ $medicines->links() }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src={{ asset("https://cdn.jsdelivr.net/npm/sweetalert2@10")}}></script>
    <script>
        // Handle the SweetAlert confirmation dialog for delete actions
        $('.swal-delete').click(function (e) {
            e.preventDefault();

            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {


                    // Send the delete request
                    $.ajax({
                        type: 'POST',
                        url: '/medicines/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": 'DELETE'
                        },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'The record has been deleted.',
                                'success'
                            );
                            // Reload the page or redirect to the index page
                            location.reload();
                        },
                        error: function (data) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the record.',
                                'error'
                            );
                        }
                    });

                }
            });
        });
    </script>
@endsection

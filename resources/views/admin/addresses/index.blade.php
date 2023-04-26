@extends('layouts.admin')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Addresses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" href="{{route('addresses.index')}}">Addresses</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @include('partials.flash-message')
        <!-- Default box -->
        <div class="card">
            <div class="card-body p-3">
                <table id="table" class="table table-striped table-borderless  text-center">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Area Name
                        </th>
                        <th style="width: 20%">
                            Street Name
                        </th>
                        <th style="width: 5%">
                            Building No.
                        </th>
                        <th style="width: 5%">
                            Floor No.
                        </th>
                        <th style="width: 5%">
                            Flat No.
                        </th>
                        <th style="width: 5%">
                            Main Address
                        </th>
                        <th style="width: 15%">
                            User Name
                        </th>
                        <th style="width: 30%">
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src={{ asset("https://cdn.jsdelivr.net/npm/sweetalert2@10")}}></script>
    <script>
        $('table').dataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('addresses.index') }}",
            columns: [
                {data: 'id'},
                {data: 'area.name'},
                {data: 'street_name'},
                {data: 'building_number'},
                {data: 'floor_number'},
                {data: 'flat_number'},
                {data: 'is_main'},
                {data: 'user.name'},
                {
                    data: 'id', orderable: false, searchable: false,
                    render: function (data, type, full, meta) {
                        return `
                        <button class="btn btn-danger btn-sm swal-delete" onclick="sweetDelete(event)"
                                data-id="{{ ':id' }}">
                            <i class="fas fa-trash-alt"></i> Delete
                            </button>`.replaceAll(':id', data);


                    },
                }
            ]
        });
    </script>
    <script>
        // Handle the SweetAlert confirmation dialog for delete actions
        function sweetDelete(e) {
            e.preventDefault();

            const id = $(e.target).data('id');
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
                        url: '/addresses/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": 'DELETE'
                        },
                        success: function (data) {
                            $('table').DataTable().ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                'The record has been deleted.',
                                'success'
                            );

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
        }
    </script>
    <script>
        $(document).ready(function(){
            $(".alert").slideDown(300).delay(5000).slideUp(300);
        });
    </script>
@endsection

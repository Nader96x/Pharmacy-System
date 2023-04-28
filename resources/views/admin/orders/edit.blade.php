@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Medicines</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" href="{{route('orders.index')}}">Orders</li>
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


            <div class="card-body p-3">
                <table id="table" class="table table-striped table-borderless text-center ">
                    <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 30%">Medicine Name</th>
                        <th style="width: 30%">Medicine Type</th>
                        <th style="width: 20%">Quantity</th>
                        <th style="width: 20%">Unit Price ($)</th>
                        <th style="width: 20%">Total Price ($)</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    @dd($order->order_medicine_quantity);--}}
                    @php
                        $total = 0;
                    @endphp
                    @foreach($order->order_medicine_quantity as $orderMedicine)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$orderMedicine->medicine->name}}</td>
                            <td>{{$orderMedicine->medicine->type->name}}</td>
                            <td>{{$orderMedicine->quantity}}</td>
                            <td>{{$orderMedicine->price}}</td>
                            <td>{{$orderMedicine->quantity*$orderMedicine->price}}</td>
                            @php
                                $total += $orderMedicine->quantity*$orderMedicine->price
                            @endphp
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="sweetDelete(event)"
                                        data-id="{{$orderMedicine->id}}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td colspan="4" class="h1 text-left">Total</td>
                        <td>{{$total}}</td>
                        <td>
                            <button class="btn btn-success btn-sm" onclick="sweetDelete(event)"
                                    data-id="{{$orderMedicine->id}}">
                                <i class="fas fa-plus"></i> Save
                            </button>
                        </td>
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->

            <div class="card-header">
                @include('partials.validation_errors')
                {{--                @dd($order)--}}
                <form action="{{ route('orders.update',$order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="medicine">Medicine</label>
                        <select name="medicine_id" id="medicine" class="form-control">
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}
                                    {{ $medicine->price }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control">
                    </div>
                    <input type="submit" value="Add" class="my-3 btn btn-success">
                </form>
            </div>
            <div class="card-footer">
                @include('partials.validation_errors')
                {{--                @dd($order)--}}
                <form action="{{ route('orders.update',$order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="medicine">Medicine</label>
                        <select name="medicine_id" id="medicine" class="form-control">
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}
                                    {{ $medicine->price }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <input type="submit" value="Add" class="my-3 btn btn-success">
                </form>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    {{-- <script src={{ asset("https://cdn.jsdelivr.net/npm/sweetalert2@10")}}></script>
     <script>
         $('table').dataTable({
             processing: true,
             serverSide: true,
             ajax: "{{ route('medicines.index') }}",
             columns: [
                 {data: 'id'},
                 {data: 'name'},
                 {data: 'price', render: $.fn.dataTable.render.number(',', '.', 2, '$'), searchable: true},
                 {data: 'type.name'},
                 {
                     data: 'id', orderable: false, searchable: false,
                     render: function (data, type, full, meta) {
                         return `
                         <a class="btn btn-info btn-sm" href="{{route('medicines.edit',':id')}}">
                             <i class="fas fa-pencil-alt">
                             </i>
                             Edit
                         </a>
                         <button class="btn btn-danger btn-sm" onclick="sweetDelete(event)"
                                 data-id="{{ ':id' }}">
                             <i class="fas fa-trash-alt"></i> Delete
                             </button>`.replaceAll(':id', data);


                     },
                 }
             ]
         })
         ;
     </script>
     --}}
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
                        url: '/medicines/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": 'DELETE'
                        },
                        success: function (data) {
                            // console.log(data);
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

        // $('.swal-delete').click(sweetDelete);
    </script>
@endsection

@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pharmacies</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Pharmacies</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
{{--            @include('partials.flash-message')--}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a class="btn btn-primary btn-sm" href="{{ route('pharmacies.create') }}">
                            <i class="fas fa-plus">
                            </i>
                            New pharmacy
                        </a>
                    </h3>

                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                ID
                            </th>
                            <th style="width: 20%">
                                Name
                            </th>
                            <th style="width: 30%">
                                Avatar
                            </th>
                            <th style="width: 30%">
                                Priority
                            </th>
                            <th style="width: 30%">
                                Area
                            </th>
                            <th style="width: 30%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pharmacies as $pharmacy)
                            <tr>
                                <td>
                                    {{ $pharmacy->id }}
                                </td>
                                <td>
                                    {{ $pharmacy->name }}
                                </td>
                                <td>
                                    {{ $pharmacy->avatar }}
                                </td>
                                <td>
                                    {{ $pharmacy->priority }}
                                </td>
                                <td>
                                    {{ $pharmacy->area->name }}
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary rounded" href="{{ route('pharmacies.edit', $pharmacy->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                @if ($pharmacy->deleted_at)
                                <td>
                                    <form method="POST" action="{{ route('pharmacies.destroy', $pharmacy->id) }}" class="d-inline" onclick="return confirm('Are you sure you want to delete this pharmacy?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger rounded"  onclick="return confirmDelete({{ $pharmacy->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                    <td>
                                        <form method="POST" action="{{ route('pharmacies.restore', $pharmacy->id) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success rounded">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @else
                                    <td>
                                    <form method="POST" action="{{ route('pharmacies.destroy', $pharmacy->id) }}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger rounded">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br> {{ $pharmacies->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

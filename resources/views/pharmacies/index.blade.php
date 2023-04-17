@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pharmacies</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Pharmacies</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
{{--            @include('partials.flash-message')--}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <a class="btn btn-primary btn-sm ml-auto" href="{{ route('pharmacies.create') }}">
                            <i class="fas fa-plus"></i>
                             New Pharmacy
                        </a>
                    </h3>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="width: 1%">ID</th>
                            <th style="width: 30%">Name</th>
                            <th style="width: 20%">Avatar</th>
                            <th style="width: 20%">Priority</th>
                            <th style="width: 20%">Area</th>
                            <th style="width: 30%"></th>
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
                                        <button type="submit" class="btn btn-danger rounded">
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

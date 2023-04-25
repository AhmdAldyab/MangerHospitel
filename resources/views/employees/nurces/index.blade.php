@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    List Nurces
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> List Nurces</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">nurces</a></li>
                <li class="breadcrumb-item active">list</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                {{-- table list nurces --}}
                <a href="{{ route('Nurse.create') }}" class="btn btn-success btn-sm">Add Nurce</a>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date of hiring</th>
                                <th>Date of birth</th>
                                <th>Specialization</th>
                                <th>Gender</th>
                                <th>Number Phone</th>
                                <th>Email</th>
                                <th>Adress</th>
                                <th>Proccess</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nurces as $nurce)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $nurce->name }}</td>
                                    <td>{{ $nurce->hiring_date }}</td>
                                    <td>{{ $nurce->birth_date }}</td>
                                    <td>{{ $nurce->specializtion->name }}</td>
                                    <td>{{ $nurce->gender->name }}</td>
                                    <td>{{ $nurce->number_phone }}</td>
                                    <td>{{ $nurce->email }}</td>
                                    <td>{{ $nurce->adress }}</td>
                                    <td>
                                        {{-- Edit Section --}}
                                        <a href="{{ route('Nurse.edit', $nurce->id) }}" class="btn btn-info btn-sm"
                                            title="edit nurce"><i class="fa fa-edit"></i></a>
                                        {{-- Delete Section --}}
                                        <a href="#" class="btn btn-danger btn-sm" title="delete section"
                                            data-toggle="modal" data-target="#delete-nurce{{ $nurce->id }}">
                                            <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                {{-- Start delete nurce --}}
                                <div class="modal fade" id="delete-nurce{{ $nurce->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    Delete {{ $nurce->name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- delete_form -->
                                            <form action="{{ route('Nurse.destroy', 'test') }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $nurce->id }}">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input id="Name" type="text" name="Name" readonly
                                                                value="Are you sure to delete" class="form-control"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End delete nurce --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

@endsection

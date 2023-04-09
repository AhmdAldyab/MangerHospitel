@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
    List Sections
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> List Sections</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">sections</a></li>
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
                {{-- table list sections --}}
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
                    Add Section
                </button>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Proccess</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->desciption }}</td>
                                    <td>
                                        {{-- Edit Section --}}
                                        <a href="#" class="btn btn-info btn-sm"
                                        data-target="#edit-section{{$section->id}}" data-toggle="modal"
                                        title="edit section"><i class="fa fa-edit"></i></a>
                                        {{-- Delete Section --}}
                                        <a href="#" class="btn btn-danger btn-sm"
                                        data-target="#delete-section{{$section->id}}" data-toggle="modal"
                                        title="delete section">
                                        <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                {{-- Start edit section --}}
                                <div class="modal fade" id="edit-section{{$section->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                Edit section 
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- edit_form -->
                                            <form action="{{ route('Section.update','test') }}" method="POST">
                                                @method('patch')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{$section->id}}">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name" class="mr-sm-2">Name :</label>
                                                            <input id="Name" type="text" name="Name" value="{{$section->name}}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1" class="mr-sm-2"> Description :</label>
                                                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3">{{$section->desciption}}</textarea>
                                                    </div>
                                                    <br><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End edit section --}}
                                {{-- Start delete section --}}
                                <div class="modal fade" id="delete-section{{$section->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                Delete {{$section->name}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- delete_form -->
                                            <form action="{{ route('Section.destroy','test') }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{$section->id}}">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input id="Name" type="text" name="Name" readonly value="Are you sure to delete" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End delete section --}}
                            @endforeach
                    </table>
                </div>
                {{-- Start Add Section --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    Add Section
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- add_form -->
                            <form action="{{ route('Section.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <label for="Name" class="mr-sm-2">Name :</label>
                                            <input id="Name" type="text" name="Name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="mr-sm-2"> Description :</label>
                                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <br><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Add</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                {{-- End Add Section --}}
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

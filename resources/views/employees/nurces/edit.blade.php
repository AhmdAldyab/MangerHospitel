@extends('layouts.master')
@section('css')

@section('title')
    Edit Nurse
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> Nurses</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Edit Nurse</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('Nurse.update','test') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <input type="hidden" name="id" value="{{$nurce->id}}">
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name" class="mr-sm-2">Name :</label>
                            <input type="text" name="name" value="{{$nurce->name}}" id="name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="birth-date" class="mr-sm-2">Birth Date :</label>
                            <input type="date" id="birth" name="birth" value="{{$nurce->birth_date}}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="hiring-date" class="mr-sm-2">Hiring Date :</label>
                            <input type="date" id="hiring" name="hiring" value="{{$nurce->hiring_date}}" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="number-phone" class="mr-sm-2">Number Phone :</label>
                            <input type="number" name="number" value="{{$nurce->number_phone}}" id="number-phone" class="form-control" required>
                        </div>
                        <div class="col-md-8">
                            <label for="email" class="mr-sm-2">Email :</label>
                            <input type="email" id="email" name="email" value="{{$nurce->email}}" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="specialization" class="mr-sm-2">Specialization :</label>
                            <select name="specialization" id="gender" class="custom-select my-1 mr-sm-2" required>
                                <option value="{{$nurce->specializtion->id}}">{{$nurce->specializtion->name}}</option>
                                @foreach ($specializations as $specialization)
                                    <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="mr-sm-2">Gender :</label>
                            <select name="gender" id="gender" class="custom-select my-1 mr-sm-2" title="select gender" required>
                                <option value="{{$nurce->gender->id}}">{{$nurce->gender->name}}</option>
                                @foreach ($genders as $gender)
                                    <option value="{{$gender->id}}">{{$gender->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="adress" class="mr-sm-2">Adress :</label>
                        <textarea name="adress" id="adress" cols="20" rows="4" class="form-control" required>
                            {{$nurce->adress}}
                        </textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="file" class="mr-sm-2">Chosse file :</label>
                            <input type="file" id="file" accept="image/*,.pdf" name="photes[]" class="file">
                        </div>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
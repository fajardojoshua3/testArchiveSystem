@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row'>
        <div class='col col-md-4 col-lg-8'>
            <h1>Employee</h1>
        </div>
    </div>
</div>
<div class='container'>
    <div class='row'>
    <div class='col col-sm-12 col-md-12 col-lg-12'>
    @include('layouts.msg')
    <a class='btn btn-primary' href="{{ route('register')}}">Register</a>
    <a class='btn btn-primary' href='/upload'>Upload File</a>
    <a href='/view' class='btn btn-primary' id='files'>Show Files</a>
    </div>
    </div>
</div>
<div class='container'>
<div class='row'>
<div class="col-md-12 col-lg-12 col-sm-12 ">
<br><br><h3>Interns</h3>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($interns as $intern)
            <tr>
                <td>{{$intern->username}}</td>
                <td>{{$intern->email}}</td>
                <td><a href="home/{{$intern->id}}/edit">View Files</a></td>
            </tr>
        @endforeach
        </tbody>
        </thead>
    </table>
    </div>
    </div>
    </div>
@endsection
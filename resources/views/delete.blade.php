@extends('layouts.app')

@section('content')
    <h3>File ID : {{$data->id}}</h3>
    <h2>File Path : {{$data->directory_path}} </h2>
    <h2>This File Belongs to : {{$data->user->email}}</h2>


    <form action="{{route('home.destroy',$data)}}" method='post'>
    {{csrf_field()}}
        <input type='hidden' name='_method' value='DELETE'>
        <input type='submit' value='Delete' class='btn btn-danger'>
    </form>
@endsection
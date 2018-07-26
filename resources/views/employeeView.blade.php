@extends('layouts.app')

@section('content')
@include('layouts.msg')
    <div class='container'>
        <div class='row'>
            <div class='col col-md-12 col-lg-12'>
                <h4>File ID : {{$file->id}}</h4>
                <h4>File Path : {{$file->directory_path}}</h4>
                <h4>{{$file->user->email}}</h3>


                <form class='form-group' action="{{route('view.destroy',$file->id)}}" method='post'>
                {{csrf_field()}}
                    <input type='hidden' name='_method' value='DELETE'>
                    <input type='submit' value='Delete' class='btn btn-danger'>
                </form>

                <form class='form-group' action="{{route('view.edit',$file->id)}}" method='post'>
                {{csrf_field()}}
                    <input type='hidden' name='_method' value='GET'>
                    <input type='submit' value='Update File' class='btn btn-default'>
                </form>
            
            </div>
        </div>
    </div>
@endsection
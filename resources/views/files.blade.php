@extends('layouts.app')


@section('content')

<div class='container'>
<div class='row'>
<div class="col-md-12 col-lg-12 col-sm-12 ">
<h2>This is {{$id->email}} Files</h2>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>File ID</th>
                <th>Directory Path</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @if(count($files) > 0)
        @foreach($files as $file)
            <tr>
                <td>{{$file->id}}</td>
                <td>{{$file->directory_path}}</td>
                <td><a href="{{route('home.destroy',$file)}}">Delete</a></td>
            </tr>
    @endforeach

    @else
        <p>No Files</p>
    @endif
        </tbody>
        </thead>
    </table>
    </div>
    </div>
    </div>
    
@endsection
@extends('layouts.app')

@section('content')
    @if(Auth::user()->position !='employee')
        <script>window.location.href='home';</script>
    @else
    <div class='container'>
    <div class='row'>
    <div class="col-md-12 col-lg-12 col-sm-12 ">
    <h3>{{$user->username}} Files</h3>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>File ID</th>
                    <th>File Path</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $datas)
                <tr>
                    <td>{{$datas->id}}</td>
                    <td>{{$datas->directory_path}}</td>
                    <td><a href="/view/{{$datas->id}}">View File</a></td>
                </tr>
            @endforeach
            </tbody>
            </thead>
        </table>
        </div>
        </div>
        </div>
    @endif

@endsection
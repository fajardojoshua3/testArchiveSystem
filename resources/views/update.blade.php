@extends('layouts.app')

@section('content')
<div class="loaderCon">
    <div class="loader">

    </div>
    <p>Please Wait..</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   @include('layouts.msg')
                    
                    <p>{{$data->directory_path}}</p>
                    <form action="{{route('home.update',$data)}}" method='POST' enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                     <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon3">Browse  File</span>
                    
                        <input type="file" name="zip"  class="form-control-file" >
                    <br><br>
                    </div>
                              
                            <input type='submit' id="wew" class="btn btn-primary" value="Upload File">
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
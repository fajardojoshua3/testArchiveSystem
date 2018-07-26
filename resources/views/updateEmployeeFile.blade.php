@extends('layouts.app')

@section('content')

<div class="container" hidden="hidden">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        
<div class="loaderCon">
    <div class="loader">

    </div>
    <p>Please Wait..</p>
</div>

            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                   @include('layouts.msg')
                    <form action="{{route('view.update',$file->id)}}" method='POST' enctype="multipart/form-data">
                    {{csrf_field()}}
                     <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon3">Browse  File</span>
                        <input type='hidden' name='_method' value='PUT'> 
                        <input type="file" name="zip" class="form-control-file" >
                    <br><br>
                    </div>
                              
                            <input type='submit' class="btn btn-primary" id='wew' value="Update File">
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
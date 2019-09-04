@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Upload Your Image

                        <a class="btn btn-primary waves-effect float-right" href="{{route('image.index')}}">
                            <span>Check All Images</span>
                        </a>
                    </div>



                    <h1>{{Session::get('message')}}</h1>

                    <form action="{{route('image.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf



                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputFile">Select Your Image</label>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="file"
                                               name="image">

                                    </div>

                                    <br>
                                    <span  class="text-danger"> {{$errors->has('image') ? $errors->first('image'):''}} </span>


                                </div>

                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>


                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

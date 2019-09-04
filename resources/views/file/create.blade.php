@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Upload Your File

                        <a class="btn btn-primary waves-effect float-right" href="{{route('file.index')}}">
                            <span>Check All File</span>
                        </a>
                    </div>



                    <h1>{{Session::get('message')}}</h1>

                    <form action="{{route('file.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf



                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputFile">File Name</label>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="text" name="file_name">
                                    </div>

                                    <br>
                                    <span  class="text-danger"> {{$errors->has('file_name') ? $errors->first('file_name'):''}} </span>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="exampleInputFile">Select Your File</label>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" type="file" name="file">
                                    </div>

                                    <br>
                                    <span  class="text-danger"> {{$errors->has('file') ? $errors->first('file'):''}} </span>
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

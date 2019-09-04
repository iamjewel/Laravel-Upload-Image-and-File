@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Your Image</div>

                    <h1>{{Session::get('message')}}</h1>

                    <form action="{{route('image.update',['image'=>$image->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")


                        <div class="card-body">


                            <div class="form-group">
                                <div class="form-line">
                                    <label>Previous Image</label>
                                    <img src="{{asset($image->image)}}" height="50" width="50">
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="exampleInputFile">Select Your Image</label>

                                <div class="form-line">
                                    <input class="form-control" type="file"
                                           name="image">

                                </div>

                                <br>
                                <span
                                    class="text-danger"> {{$errors->has('image') ? $errors->first('image'):''}} </span>


                            </div>

                        </div>


                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

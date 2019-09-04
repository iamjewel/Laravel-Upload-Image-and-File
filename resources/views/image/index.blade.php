@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header text-center">All Your Images</div>

                    <h1 class="text-center alert-success">{{Session::get('message')}}</h1>

                    <a href="{{route('image.create')}}" class="btn btn-info">Add Image</a>

                    <table class="table table-bordered text-center">
                        <thead>

                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Image Small</th>
                            <th>Action</th>
                        </tr>

                        </thead>

                        <tbody>

                        @if($images->count()>0)
                            @php($i=1)
                            @foreach($images as $image)
                                <tr>
                                    <td>{{$i++}}</td>

                                    <td>
                                        <img src="{{asset($image->image)}}" height="40" width="40">
                                    </td>

                                    <td>
                                        <img src="{{asset($image->image)}}" height="40" width="40">
                                    </td>


                                    <td>

                                        <div class="row">

                                            <div class="col-sm-8" style="margin-top: 3px">
                                                <a href="{{route('image.edit',$image->id)}}"
                                                   class="fa fa-edit btn btn-info"></a>
                                            </div>

                                            <div class="col-sm-4" style="margin-left: -20px">
                                                <form action="{{route('image.destroy',['image'=>$image->id])}}"
                                                      method="post">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')

                                                    <button type="submit" class="fa fa-trash btn btn-danger"></button>

                                                </form>
                                            </div>


                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <h2 class="alert-warning text-center">No Image Data Available</h2>
                        @endif

                        </tbody>

                    </table>


                    <div >
                        {{ $images->links() }}
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header text-center">All Your File</div>

                    <h1 class="text-center alert-success">{{Session::get('message')}}</h1>

                    <a href="{{route('file.create')}}" class="btn btn-info">Add File</a>

                    <table class="table table-bordered text-center">
                        <thead>

                        <tr>
                            <th>Sl</th>
                            <th>File Name</th>
                            <th>Download File</th>
                            <th>Action</th>
                        </tr>

                        </thead>

                        <tbody>

                        @if($files->count()>0)
                            @php($i=1)
                            @foreach($files as $file)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$file->file_name}}</td>
                                    <td>
                                        <a href="{{asset($file->file)}}">Download File</a>
                                    </td>

                                    <td>

                                        <div class="row">

                                            <div class="col-sm-8" style="margin-top: 3px">
                                                <a href="{{route('file.edit',$file->id)}}"
                                                   class="fa fa-edit btn btn-info"></a>
                                            </div>

                                            <div class="col-sm-4" style="margin-left: -20px">
                                                <form action="{{route('file.destroy',['image'=>$file->id])}}"
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
                            <h2 class="alert-warning text-center">No File Data Available</h2>
                        @endif

                        </tbody>

                    </table>


                    <div>
                        {{ $files->links() }}
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.auth')



@section('title', 'posts')


@section('styles')

    <style>
        #outer{
            text-align:center;
        }

        .inner{
            display:inline-block;
        }

    </style>

    <link href="{{asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css')}}" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"  rel="stylesheet">

@endsection

@section('content')

    <div class="content-wrapper">
        <div class="content">
            <!-- Masked Input -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Create Post</h2>

                    @if(Session::has('alert-success'))

                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" >&times;</button>
                             {{session::get('alert-success')}}
                        </div>
                    @endif



                </div>
                <div class="card-body">
                    @if(count($posts) > 0)
                        <table class="table" id="posts">


                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">User</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($posts as $post)

                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>{{Str::limit($post->description, 15)}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->category->name}}</td>
                                    <td>{{$post->status == 1 ? 'Active' : 'Inactive'}}</td>

                                    <td>
                                        <a class="btn btn-success btn-sm inner" href="{{route('posts.show', $post->id)}}"><li class="fas fa-eye"></li></a>
                                        <a class="btn btn-info btn-sm inner" href="{{route('posts.edit', $post->id)}}"><li class="fas fa-edit"></li></a>
                                        <form class="inner" method="post" action="{{route('posts.destroy', $post->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button><a class="btn btn-danger btn-sm"><li class="fas fa-trash"></li></a></button>
                                        </form>

                                    </td>

                                </tr>


                            @endforeach

                            </tbody>



                        </table>

                    @else

                        <h3 class="text-center text-danger">No Posts Found</h3>
                    @endif



                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"')}}"></script>

    <script>
        $(document).ready(function()  {

            $('#posts').DataTable({
                'bLengthChange':false,
            });
        });


    </script>
@endsection

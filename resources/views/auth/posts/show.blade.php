@extends('layouts.auth')



@section('title', 'show posts')


@section('styles')

    <link href="{{asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css')}}" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"  rel="stylesheet">

@endsection

@section('content')

    <div class="content-wrapper">
        <div class="content">
            <!-- Masked Input -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Show Post</h2>

                </div>
                <div class="card-body">
                    @if($post)
                        <table class="table" id="posts">
                            <tbody>
                            <tr>
                               <tr>
                                <th scope="col">Title</th>
                                <td>{{$post->title}}</td>
                               </tr>

                               <tr>
                                   <th scope="col">Description</th>
                                   <td>{{$post->description}}</td>
                               </tr>

                               <tr>
                                   <th scope="col">Category</th>
                                   <td>{{$post->category->name}}</td>
                               </tr>

                               <tr>
                                    <th scope="col">User</th>
                                    <td>{{$post->user->name}}</td>
                               </tr>

                                <tr>
                                    <th scope="col">Status</th>
                                    <td>{{$post->status == 1 ? 'puplished' : 'drafted'}}</td>
                                </tr>

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


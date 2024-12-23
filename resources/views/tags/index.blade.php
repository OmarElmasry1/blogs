@extends('layouts.auth')



@section('title', 'tags')


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
                    <h2>Tags</h2>

                </div>
                <div class="card-body">
                    @if(count($tags) > 0)
                        <table class="table" id="posts">


                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($tags as $tag)

                                <tr>
                                    <td>{{$tag->id}}</td>
                                    <td>{{$tag->name}}</td>
                                </tr>


                            @endforeach

                            </tbody>



                        </table>

                    @else

                        <h3 class="text-center text-danger">No tags Found</h3>
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


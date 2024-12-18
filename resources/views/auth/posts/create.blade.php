@extends('layouts.auth')

@section('title', 'Create Post | Admin Dashboard')

@section('styles')

    <link rel="stylesheet" href="{{asset('assets/auth/css/multiple.css')}}"
@endsection


@section('content')

    <div class="content-wrapper">
        <div class="content">
            <!-- Masked Input -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Create Post</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
                <div class="card-body">
                    <form method="post" action="{{route('posts.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label  class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Enter Your Title"  >

                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Description</label>
                            <textarea type="text" name="description" class="form-control" cols="30" rows="3" style="resize: none" placeholder="Enter The Description " ></textarea>
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">Is Published</label>
                            <select name="status"  class="form-control" >
                                <option value="" disabled selected>Choose Option</option>
                                <option value="1" >Publish</option>
                                <option value="0" >Draft</option>
                            </select>

                        </div>


                        <div class="mb-3 form-group">
                            <label  class="form-label">Categories</label>
                            <select name="category"  class="form-control" >
                                <option value="" disabled selected>Choose Option</option>
                                   @if(count($categories) > 0)
                                       @foreach($categories as $category)

                                           <option value="{{$category->id}}">{{$category->name}}</option>

                                       @endforeach
                                   @endif
                            </select>

                        </div>

                        <div class="mb-3 form-group">
                            <label  class="form-label">Tags</label>
                            <select name="tag[]"  class="form-control selectpicker" multiple data-live-search >
                                <option value="" disabled selected>Choose Option</option>
                                @if(count($tags) > 0)
                                    @foreach($tags as $tag)

                                        <option value="{{$tag->id}}">{{$tag->name}}</option>

                                    @endforeach
                                @endif
                            </select>

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

   <script src="{{asset('assets/auth/js/multiple.js')}}" ></script>
@endsection

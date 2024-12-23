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
                    <h2>Edit Post</h2>

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
                    <form method="post" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" placeholder="Enter Your Title">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="3" style="resize: none" placeholder="Enter The Description">{{ old('description', $post->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Is Published</label>
                            <select name="status" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                <option @selected(old('status', $post->status) == 1) value="1">Publish</option>
                                <option @selected(old('status', $post->status) == 0) value="0">Draft</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Categories</label>
                            <select name="category" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                @foreach($categories as $category)
                                    <option @selected(old('category', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tags</label>
                            <select name="tags[]" class="form-control selectpicker" multiple data-live-search>
                                @foreach($tags as $tag)
                                    <option @selected($post->tags->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
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


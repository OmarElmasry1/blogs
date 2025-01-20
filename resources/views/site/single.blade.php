@extends('layouts.site')


@section('content')

<section class="page-title bg-1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <span class="text-white">News details</span>
            <h1 class="text-capitalize mb-4 text-lg">Blog Single</h1>
            <ul class="list-inline">
              <li class="list-inline-item"><a href="{{url('/')}}" class="text-white">Home</a></li>
              <li class="list-inline-item"><span class="text-white">/</span></li>
              <li class="list-inline-item text-white-50">News details</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  @if ($blog)

  <section class="section blog-wrap bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <div class="single-blog-item">
                            <img loading="lazy" src="{{asset('storage/auth/posts/'. $blog->image->image)}}" alt="blog" class="img-fluid rounded">

                            <div class="blog-item-content bg-white p-5">
                                <div class="blog-item-meta bg-gray pt-2 pb-1 px-3">
                                    <span class="text-muted text-capitalize mr-3"><i class="ti-pencil-alt mr-2"></i>Creativity</span>
                                    <span class="text-muted text-capitalize mr-3"><i class="ti-comment mr-2"></i> {{count($comments)}}</span>
                                    <span class="text-black text-capitalize mr-3"><i class="ti-time mr-1"></i> 28th January</span>
                                </div>

                                <h2 class="mt-3 mb-4">{{$blog->title}}</h2>
                                <p class="lead mb-4">{{$blog->description}}</p>


                                <div class="tag-option mt-5 d-block d-md-flex justify-content-between align-items-center">
                                    <ul class="list-inline">
                                        <li>Tags:</li>
                                        @foreach ($blog->tags as $tag )
                                        <li class="list-inline-item"><a href="#" rel="tag">{{$tag->name}}</a></li>

                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
    <div class="alert text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(Session::has('alert-success'))

<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Well done!</h4> {{Session::get('alert-success')}}
    <hr>
    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
  </div>

  @endif

                    <div class="col-lg-12 mb-5">

                    <form action="{{route('post.comment', $blog->id)}}" method="post" >
                        @csrf
                        <div class="form-group">
                            <label for=""><strong>Comment</strong></label>
                            <textarea class="form-control mb-3" name="comment" id="comment" class="form-control" cols="20" rows="3"
                            placeholder="Comment" style="resize: no"></textarea>
                            <button type="submit" class="btn btn-info btn-sm" style="float:right">Comment</button>

                        </div>

                    </form>

                    </div>

                    <div class="col-lg-12 mb-5">
                       @if (count($comments) > 0)
                       <div class="comment-area card border-0 p-5">
                        <h4 class="mb-4">{{count($comments)}} comments</h4>
                        <ul class="comment-tree list-unstyled">
                            @foreach ($comments as $comment )
                            <li class="mb-5">
                                <div class="comment-area-box">
                                    <img loading="lazy" alt="comment-author" src="{{asset('assets/site/images/blog/test1.jpg')}}" class="img-fluid float-left mr-3 mt-2">

                                    <h5 class="mb-1">{{$comment->user ? $comment->user->name : ''}}</h5>
                                    <span>{{$comment->user ? $comment->user->email : ''}}</span>

                                    <div class="comment-meta mt-4 mt-lg-0 mt-md-0 float-lg-right float-md-right">
                                        <span class="date-comm">Posted {{$comment->user ? date('d m y', strtotime($comment->user->created_at))  : ''}} </span>
                                    </div>

                                    <div class="comment-content mt-3">
                                        <p>{{$comment->user ? $comment->comment : ''}} </p>
                                    </div>

                                    <span class="show-reply text-primary" style="float:right; cursor:pointer"><strong>Show Reply</strong></span>

                                    <div class="form-group comment-reply-div">
                                       <form  method="post" action="{{route('comment.reply', $comment->id)}}">
                                        @csrf
                                        <textarea class="form-control mb-3" name="reply" id="reply" class="form-control" cols="20" rows="3"
                                        placeholder="Reply" ></textarea>
                                        <button class="btn btn-info btn-sm mt-3" style="float:right">reply</button>

                                       </form>
                                    </div>


                                </div>
                            </li>
                            @endforeach


                        </ul>
                    </div>
                       @endif
                    </div>

                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-wrap">


                    @if (count($latestPosts) > 0)
                    <div class="sidebar-widget latest-post card border-0 p-4 mb-3">
                        <h5>Latest Posts</h5>

                        @foreach ($latestPosts as $post )
                        <div class="media border-bottom py-3">
                            <a href="{{route('singleBlog', $post->id)}}"><img loading="lazy" class="mr-4" src="{{asset('storage/auth/posts/'. $post->image->image)}}" style="width:60px" alt="blog"></a>
                            <div class="media-body">
                                <h6 class="my-2"><a href="{{route('singleBlog', $post->id)}}">{{$post->title}}</a></h6>
                                <span class="text-sm text-muted">{{date('d M y', strtotime($post->user->created_at))}}</span>
                            </div>
                        </div>
                        @endforeach




                    </div>
                    @endif



                    <div class="sidebar-widget bg-white rounded tags p-4 mb-3">
                        <h5 class="mb-4">Tags</h5>

                        @if (count($tags) > 0)

                        @foreach ($tags as $tag)


                        <a href="{{ route('singleBlog', $tag->post->first()) }}">{{ $tag->name }}</a>

                        @endforeach

                            @else

                            <h2 class="text-danger text-center">No Tags Found</h2>

                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  @else

  <h3 class="text-danger text-center mt-5">please back and try again</h3>

  @endif



@endsection


@section('scripts')

<script>
$('.comment-reply-div').hide();

    $(document).ready(function() {

        $('.show-reply').click (function() {

           $(this).next('.comment-reply-div').toggle('swing');

        });

    });
</script>

@endsection


<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Comment_replies;
use App\Models\Post;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   public function commentPost (Request $request , $postId) {



        $request->validate([
            'comment' => ['required', 'string', 'max:3000']
        ]);


        if(auth()->check()) {


            $post = Post::find($postId);

            if(!$post) {
                return back()->withErrors('error is happend');
            }

            Comment::create([

                'post_id' => $postId,
                'user_id' => auth()->id(),
                'comment' => $request->comment

            ]);

         $request->Session()->flash('alert-success', 'comment added successfully');


        }
     return back();
   }


   public function replyPost (Request $request, $commenId) {


    $comment_id = $commenId;
    $comment = $request->comment;


    Comment_replies::create([

        'comment_id' => $commenId,
        'user_id' => auth()->id(),
        'comment' => $comment

    ]);

    $request->Session()->flash('alert-success', 'comment added successfully');
    return back();
   }


}

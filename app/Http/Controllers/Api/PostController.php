<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostRresource;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PostController extends Controller
{

    use apiResponseTrait;
    public function index() {

        $posts = PostRresource::Collection(Post::get());


        return $this->apiResponse($posts, 200, 'goooooood');

    }

    public function show($id) {

        $post = Post::find($id);


        if($post) {

            return $this->apiResponse(new PostRresource($post), 200, 'goood luck');

        }

        return $this->apiResponse(null, 404, 'not found');
    }

    public function store(Request $request ) {

        $request->validate([
            'file' => ['required', 'image', 'mimes:jpg'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
            'status' => ['required', 'string'],
          
        ]);

        if($file = $request ->file('file')) {


        $fileName = $this->uploadFile($file);
        $image = $this->storeImage($fileName);
        }

      $post = Post::create([
                    'image_id' => $image->id,
                    'user_id' =>auth()->id(),
                    'title' => $request->title,
                    'description' => $request->description,
                    'category_id' => $request->category,
                    'status' => $request->status,
      ]);

      if($post) {
        return $this->apiResponse(new PostRresource($post), 201, 'created successfully');
      }

      return $this->apiResponse(null, 404, 'the post doesnt created');


    }

    public function update(Request $request ,$id ) {

        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $post = Post::find($id); 

        if(!$post) {
    
          return $this->apiResponse(null, 404, 'the post doesnt updated');
        }


      $post->update($request->all());

      if($post) {
        return $this->apiResponse(new PostRresource($post), 200, 'updated successfully');
      }


    }

    public function destroy($id) {

        $post = Post::find($id);

        if(!$post) {
    
            return $this->apiResponse(null, 404, 'the post doesnt found');
          }

          $post->comments()->delete();

        $post->delete($id);
        if($post) {
            return $this->apiResponse(null, 200, 'deleted successfully');
          }
    
    }

}

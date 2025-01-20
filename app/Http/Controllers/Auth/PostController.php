<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('auth.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('auth.posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            DB::beginTransaction();




                $request->validate([
                    'file' => ['required', 'image', 'mimes:jpg'],
                    'title' => ['required', 'string'],
                    'description' => ['required', 'string'],
                    'category' => ['required', 'string'],
                    'status' => ['required', 'string'],
                    'tags' => ['required', 'array'],
                    'tags.*' => ['required', 'string']
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

                foreach ($request->tags as $tag) {

                    $post->tags()->attach($tag);

                }

                DB::commit();

                $request->session()->flash('alert-success', 'Post Created Successfully');
                return to_route('posts.index');

        }

    catch (\Exception $ex) {
            DB::rollback();
            return back()->withErrors($ex->getMessage());
    }

   return $request->all();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('auth.posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories= Category::all();
        $tags= Tag::all();
        return view('auth.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {


        $request->validate([
            'file' => ['required', 'image', 'mimes:jpg'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
            'status' => ['required', 'string'],
            'tags' => ['required', 'array'],
            'tags.*' => ['required', 'string']
        ]);

        if($file = $request ->file('file')) {

            $imageName = null;

            if($post->image) {

                $imageName = $post->image->image;

                $imagePath = public_path('storage/auth/posts/');

                if (file_exists( $imagePath . $imageName)) {
                    unlink($imagePath . $imageName);
                }

            }

                $fileName = $this->uploadFile($file);

                $post->image->update([
                    'image' => $fileName
                ]);


            $post->update([
                'user_id' =>auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category,
                'status' => $request->status,

            ]);

            }



        foreach ($request->tags as $tag) {

            $post->tags()->attach($tag);

        };

        $request->session()->flash('alert-success', 'Post Updated Successfully');
        return to_route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

       if(! $post) {
           abort(404);
       }

       $post->tags()->detach();

       $post->delete();
        session()->flash('alert-success', 'Post Deleted Successfully');

       return to_route('posts.index');
    }

    private function uploadFile ($file) {

        $fileName = rand(100,  1000000). time() .$file->getClientOriginalName();
        $filePath = public_path('/storage/auth/posts/');
        $file->move($filePath, $fileName);

        $image = image::create([

            'image' => $fileName,
            'type' => image::post_image
        ]);


        return $fileName;

    }


    private function storeImage( $fileName) {

        $image = image::create([

            'image' => $fileName,
            'type' => image::post_image
        ]);

        return $image;
    }
}

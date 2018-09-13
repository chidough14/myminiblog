<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
       $posts = Post::with('user')->orderBy('id', 'desc')->paginate(5);

       return response()->json($posts, 200);
    }

    public function store(Request $request){
        $this->validate($request, [
           'title'=> 'required',
           'body'=> 'required'
        ]);

        $post = Post::create([
            'title'=> $request->title,
            'body'=> $request->body,
            'user_id'=> $request->user()->id
        ]);

        $pp = Post::with('user')->where('id', $post->id)->get();

        return response()->json($pp, 201);

     }

     public function singlepost($id){
        $post = Post::with('user')->where('id', $id)->get();

        return response()->json($post, 200);
     }

     public function getEditPost($id){
        $post = Post::where('id', $id)->get();

        return response()->json($post, 200);
     }

     public function updatepost(Request $request, $id){
        $this->validate($request, [
            'title'=> 'required',
            'body'=> 'required'
         ]);

         $post = Post::find($id);

         $post->update($request->all());

         $pp = Post::with('user')->where('id', $post->id)->get();

        return response()->json($pp, 201);

     }


     public function getuserposts( $id){
        $post = Post::where('user_id', $id)->get();

        return response()->json($post, 201);
     }
}

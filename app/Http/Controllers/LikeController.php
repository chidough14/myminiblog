<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likepost(Request $request){
       $like = Like::create([
           'post_id'=> $request->postid,
           'user_id'=> Auth::user()->id
       ]);

       return response()->json(['message'=>'created'], 200);
    }

    public function unlikepost(Request $request){
        $like = Like::where('post_id', $request->postid)
                  ->where('user_id', Auth::user()->id)->first();

        $like->delete();

        return response()->json(['message'=>'unliked'], 200);
     }

    public function getlikes($id){
        $like = Like::where('post_id', $id)->count();

        return response()->json($like, 200);
     }

     public function checklikes($id){
        $like = Like::where('post_id', $id)
                  ->where('user_id', Auth::user()->id)->count();

        return response()->json($like, 200);
     }
}

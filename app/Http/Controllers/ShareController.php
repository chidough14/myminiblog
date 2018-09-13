<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;
use Illuminate\Support\Facades\Auth;


class ShareController extends Controller
{
    public function sharepost(Request $request){
       $share = Share::create([
           'user_id'=> Auth::user()->id,
           'post_id'=> $request->postid,
           'post_user_id'=> $request->postersid,
           'post_title'=> $request->posttitle,
           'posted_by'=> $request->postersname,
           'shared_by'=> Auth::user()->name
       ]);

       return response()->json($share, 200);
    }


    public function checkshared($id){
       $share = Share::where('user_id', Auth::user()->id)
                  ->where('post_id', $id)->count();


        return response()->json($share, 200);
    }

    public function unsharepost($id){
        $share = Share::where('user_id', Auth::user()->id)
                   ->where('post_id', $id)->first();

        $share->delete();


         return response()->json(['message'=> 'Unshared'], 200);
     }
}

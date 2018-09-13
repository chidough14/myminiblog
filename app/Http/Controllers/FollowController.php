<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use App\Share;
use Illuminate\Support\Facades\Auth;


class FollowController extends Controller
{
    public function followuser (Request $request){
        $follow = Follow::create([
            'follower_id'=> Auth::user()->id,
            'followed_id'=> $request->id
        ]);

        return response()->json($follow, 200);
    }

    public function unfollowuser ($id){
        $follow = Follow::where('follower_id', Auth::user()->id)
                  ->where('followed_id', $id)->first();

        $follow->delete();

        return response()->json(['message'=> 'Unfollowed'], 200);
    }

    public function checkfollowed ($id){
        $follow = Follow::where('follower_id', Auth::user()->id)
                  ->where('followed_id', $id)->count();

        return response()->json($follow, 200);
    }

    public function getfollow ($id){
        $follow = Follow::where('follower_id', Auth::user()->id)->get();

        $ft = array();
        $share = array();

        foreach($follow as $ff){
            $ft[] = $ff->followed_id;

            $share = Share::whereIn('user_id', $ft)->get();
        }

        return response()->json($share, 200);
    }
}

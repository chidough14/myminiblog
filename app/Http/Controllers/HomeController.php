<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getloggedinuser()
    {
        return Auth::user()->id;
    }

    public function getuser($id)
    {
        $user = User::find($id);

        return response()->json($user, 200);
    }

    public function saveimage(Request $request)
    {
        if($request->get('image'))
        {
           $image = $request->get('image');
           $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
           \Image::make($request->get('image'))->save(public_path('img/').$name);
         }


         $user = User::where('id', Auth::user()->id)->first();

         $user->image = $name;
         $user->save();

         return response()->json($user, 200);



    }
}

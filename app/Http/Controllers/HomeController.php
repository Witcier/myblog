<?php

namespace App\Http\Controllers;

use App\Posts;
use App\tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

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
    	$user = Auth::user();
		if($user->hasRole('admin')){
			$hot_post = Posts::orderby('view','desc')->take(10)->get();
			$post_num = Posts::all()->count();
			$tag_num = tag::all()->count();
			$user_num = User::all()->count();

			$tags = tag::all();
            foreach ($tags as $tag){
                $tag_name = $tag->name;
                $tag_post_count = $tag->posts()->count();
            }
            $bar_data = ([
                'tag_name' => $tag_name,
                'tag_post_count' => $tag_post_count
            ]);

            $data = compact('user','post_num','tag_num','user_num','hot_post');

			return view('admin', $data,compact('bar_data','vardata'));
		}
		else{
			return redirect(route('article.index'));
		}
    }
}

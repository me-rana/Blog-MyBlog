<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class BlogController extends Controller
{ 
    //
    function read($view_file, $perpage, $data){
        $posts = Post::where('status','1')->latest()->paginate($perpage);
        return View($view_file, compact('posts'))->with($data)->with('i',(request()->input('page',1)-1)*$perpage);
    }

    function read_one($view_file, $slug, $data){
        $read_one = Post::where('slug', $slug)->where('status',1)->first();
        return view($view_file, compact('read_one'))->with($data);
    }
}

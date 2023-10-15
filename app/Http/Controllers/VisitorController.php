<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class VisitorController extends Controller
{
    //
    protected function dashboard(){
        return view('backend.visitor.dashboard');
    }
    protected function comments(){
        $PostCount = 8;
        $comments = Comment::rightJoin('posts','comments.post_id','=','posts.id')
                    ->where('user_id',Auth::user()->id)
                    ->select('comments.*','posts.title','posts.slug')
                    ->get();

        return view('backend.visitor.comments',compact('comments'))->with('i',(request()->input('page',1)-1)*$PostCount);
    }
}

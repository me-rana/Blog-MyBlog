<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Contact;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;


class ViewController extends Controller
{
    //
    function index(){
        $PostCount = 8;
        $data = Post::where('status','1')->latest()->paginate($PostCount);
        $all_category = Category::all();
        $count = count($data);
        $rand_post = rand(1,$count);
        $feature_post = Post::first();
        return view ('frontend.index',compact('data','all_category','feature_post'))->with('i',(request()->input('page',1)-1)*$PostCount);
    }
    function about(){
        return view('frontend.about');
    }
    function contact(){
        return view('frontend.contact');
    }
    function access(){
        if(Auth::user()->role == 1){
            return redirect()->route('author.dashboard');
        }
        if(Auth::user()->role == 2){
            return redirect()->route('admin.dashboard');
        }
        if(Auth::user()->role == 3){
            return redirect()->route('visitor.dashboard');
        }
        else{
            return redirect()->route('dashboard');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
    protected function singlePost($slug){
        $article = Post::where('slug', $slug)->first();
        $uid = $article->author_id;
        $author_info = User::where('id',$uid)->first();
        $category_info = Category::where('id',$article->category)->first();
        $all_category = Category::all();
        $comments = Comment::rightJoin('users','comments.user_id','=','users.id')
                    ->where('parent_id',null)
                    ->where('post_id',$article->id)
                    ->select('comments.*','users.name')
                    ->get();
        $replies = Comment::rightJoin('users','comments.user_id','=','users.id')
                    ->where('post_id',$article->id)

                    ->select('comments.*','users.name')
                    ->get();


        return view('frontend.singlepost', compact('article','author_info','category_info','all_category','comments','replies'));
    }



    function category($slug){
        $PostCount = 8;
        $cat_info= Category::where('cat_slug', $slug)->first();
        $data = Post::where('category',$cat_info->id)->paginate($PostCount);
        $all_category = Category::all();
        return view ('frontend.category',compact('data','all_category','cat_info'))->with('i',(request()->input('page',1)-1)*$PostCount);
    }
    protected function form_submit(Request $req): RedirectResponse{
        $validated = $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'contact' => 'required',
        ]);

        $cform = new Contact();
        $cform->name = $req->name;
        $cform->email = $req->email;
        $cform->message = $req->message;
        $cform->phone = $req->contact;
        $cform->save();
        return redirect()->back()->with('message','Success!Form submitted Successfully');
    }
    protected function comment(Request $req){
        $comment = new Comment();
        $comment->post_id = $req->post_id;
        $comment->parent_id = $req->parent_id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $req->comment;
        $comment->save();
        return redirect()->back();
    }
}

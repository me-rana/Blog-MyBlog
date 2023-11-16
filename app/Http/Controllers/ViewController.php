<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\BlogController;
use App\Http\Controllers\Helper\CategoryController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Contact;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;



class ViewController extends Controller
{

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


    //Support Function
    function support(){
        $all_category = Category::all();
        $feature_post = Post::first();
        $support_data = compact('all_category', 'feature_post');
        return $support_data;
    }
    // Main Task Started from here ------------------------------------------------------------------>
    function index(){
        $data = $this->support();
        $posts = new BlogController();
        $action = $posts->read('frontend.index', 8, $data);
        return $action;
    }

    protected function singlePost($slug){
        $support = $this->support();
        $post = new BlogController();
        $action = $post->read_one('frontend.singlepost', $slug, $support);
        return $action;
    }

    function about(){
        return view('frontend.about');
    }

    function contact(){
        return view('frontend.contact');
    }
    function myquery(Request $request){
        $perpage = 8;
        $data = $this->support();
        $posts = Post::where('title','LIKE','%'.$request->myquery.'%')->latest()->paginate($perpage);
        return view('frontend.index',compact('posts'))->with($data)->with('i',(request()->input('page',1)-1)*$perpage);
    }
    
    function category($slug){
        $data = $this->support();
        $category = new CategoryController();
        $action = $category->read_one('frontend.category', $slug, $data);
        return $action;
    }
    protected function form_submit(Request $req): RedirectResponse{
        $req->validate([
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

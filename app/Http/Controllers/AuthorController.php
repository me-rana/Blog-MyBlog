<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class AuthorController extends Controller
{
    //
    protected function dashboard(){
        return view('backend.author.dashboard');
    }
    protected function categories(){
        $PostCount = 8;
        $data = Category::latest()->paginate($PostCount);
        return view('backend.author.categories',compact('data'))->with('i',(request()->input('page',1)-1)*$PostCount);;
    }
    public function getslug(Request $req){
        $slug = SlugService::createSlug(Post::class, 'slug', $req->title);
        return response()->json([
            'status => true',
            'slug' => $slug
        ]);
    }
    public function getCatslug(Request $req){
        $slug = SlugService::createSlug(Category::class, 'cat_slug', $req->cat_name);
        return response()->json([
            'status => true',
            'cat_slug' => $slug
        ]);
    }
    protected function posts(){
        $PostCount = 8;
        $data = Post::rightJoin('categories', 'posts.category', '=', 'categories.id')
        ->latest('posts.created_at')
        ->where('author_id', Auth::user()->id)
        ->where('posts.deleted_at',NULL)
        ->where('categories.deleted_at', NULL)
        ->select('posts.*','categories.cat_name')
        ->paginate($PostCount);
        return view('backend.author.posts',compact('data'))->with('i',(request()->input('page',1)-1)*$PostCount);
    }
    protected function newcategory(){
        return view('backend.author.addcategory');
    }
    protected function addpost(){
        $title = "New Post";
        $data = Category::all();
        return view('backend.author.addpost',compact('data','title'));
    }
    protected function updatepost($id){
        $title = "New Post";
        $post = Post::where('id',$id)->first();
        $data = Category::all();
        return view('backend.author.addpost',compact('data','title','post'));
    }
    protected function storepost(Request $req){
         if (is_null($req->id)){
            $post = new Post();
         $post->title = $req->title;
         $post->status = $req->status;
         $post->slug = $req->slug;
         $post->tag = $req->tag;
         $post->description = $req->description;
         $post->author_id = Auth::user()->id;
         $post->category = $req->category;
         //Image
         if(!is_null($req->file('image'))){
            $url = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $url;
            $req->file('image')->storeAs('public/image', $image);
            $post->image_path = $image;
         }
         //
         $post->save();
         }
         else{
            $post = Post::find($req->id)->first();
            $post->title = $req->title;
            $post->status = $req->status;
            $post->slug = $req->slug;
            $post->tag = $req->tag;
            $post->description = $req->description;
            $post->author_id = Auth::user()->id;
            $post->category = $req->category;
            //Image
            if(!is_null($req->file('image'))){
                $url = $req->file('image')->getClientOriginalName();
                $image = rand(11111, 99999) . $url;
                $req->file('image')->storeAs('public/image', $image);
                $post->image_path = $image;
         }
         //
         $post->update();
         }
         return redirect(route('author.post'));
    }
    protected function storecategory(Request $req){
        $cat = new Category();
        $cat->cat_name = $req->cat_name;
        $cat->cat_slug = $req->cat_slug;
        $cat->cat_des = $req->cat_des;
        //Image
        $url = $req->file('image')->getClientOriginalName();
        $image = rand(11111, 99999) . $url;
        $req->file('image')->storeAs('public/image', $image);
        $cat->cat_path = $image;
        //
        $cat->save();
        return redirect(route('author.category'));
    }
    protected function delete_post($id){
        $data = Post::find($id);
        if(Auth::user()->role == 1 && Auth::user()->id == $data->author_id){
            $data->delete();
            return redirect( route('author.post'))->with('message','Product Removed Successfully');
        }else{
            return redirect( route('access'))->with('message','Access Denied');
        }
    }
    protected function delete_category($id){
        $data = Category::find($id);
        if(Auth::user()->role == 2){
            $data->delete();
            return redirect( route('author.category'))->with('message','Product Removed Successfully');
        }else{
            return redirect( route('access'))->with('message','Access Denied');
        }
    }
    public function contact(){
        return view('backend.author.contact');
    }
    public function index(){
        return redirect()->route('author.dashboard');
    }
    public function faq(){
        return view('backend.author.faq');
    }

}

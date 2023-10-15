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

class AdminController extends Controller
{
    //
    protected function dashboard(){
        return view('backend.admin.dashboard');
    }
    protected function categories(){
        $PostCount = 8;
        $data = Category::latest()->paginate($PostCount);
        return view('backend.admin.categories',compact('data'))->with('i',(request()->input('page',1)-1)*$PostCount);
    }
    protected function delete_category($id){
        $data = Category::find($id);
        if(Auth::user()->role == 2){
            $data->delete();
            return redirect( route('admin.category'))->with('message','Product Removed Successfully');
        }else{
            return redirect( route('access'))->with('message','Access Denied');
        }
    }
    protected function newcategory(){
        $title = 'New Category';
        return view('backend.admin.addcategory',compact('title'));
    }
    protected function updatecategory($id){
        $title = 'New Category';
        $category = Category::where('id',$id)->first();
        $cid = $id;
        return view('backend.admin.addcategory',compact('category','cid','title'));
    }
    protected function storecategory(Request $req){
        if (is_null($req->cid)){
            $cat = new Category();
        $cat->cat_name = $req->cat_name;
        $cat->cat_slug = $req->cat_slug;
        $cat->cat_des = $req->cat_des;
        if(!is_null($req->file('image'))){
            $url = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $url;
            $req->file('image')->storeAs('public/image', $image);
            $cat->cat_path = $image;
         }
        $cat->save();
        }
        else{
        $cat = Category::where('id',$cid)->first();
        $cat->cat_name = $req->cat_name;
        $cat->cat_slug = $req->cat_slug;
        $cat->cat_des = $req->cat_des;
        //Image
        if(!is_null($req->file('image'))){
            $url = $req->file('image')->getClientOriginalName();
            $image = rand(11111, 99999) . $url;
            $req->file('image')->storeAs('public/image', $image);
            $cat->cat_path = $image;
        }
        $update->save();
        }
        return redirect(route('admin.category'));
    }
    protected function posts(){
        $PostCount = 8;
        $posts = Post::rightJoin('categories', 'posts.category', 'categories.id')
        ->where('posts.deleted_at',NULL)
        ->where('posts.id','!=',null)
        ->select('posts.*','categories.cat_name')
        ->latest()
        ->paginate($PostCount);
        return view('backend.admin.posts',compact('posts'))->with('i',(request()->input('page',1)-1)*$PostCount);
    }
    protected function addpost(){
        $title ="New Post";
        $data = Category::all();
        return view('backend.admin.addpost',compact('data','title'));
    }
    protected function updatepost($id){
        $title = "Update Post";
        $post = Post::where('id',$id)->first();
        $pid = $id;
        $data = Category::all();
        return view('backend.admin.addpost',compact('data','title','post','pid'));
    }
    protected function userRole(Request $req){
        $user = User::where('id',$req->uid)->first();
        $user->role = $req->role;
        $user->update();
        return redirect()->back()->with('message','Successfully updated user role');
    }
    protected function storepost(Request $req){
        if (is_null($req->pid)){
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
            $post = Post::where('id',$req->pid)->first();
            $post->title = $req->title;
            $post->status = $req->status;
            $post->slug = $req->slug;
            $post->tag = $req->tag;
            $post->description = $req->description;
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
        return redirect(route('admin.post'));
   }
   protected function delete_post($id){
    $data = Post::find($id);
    if(Auth::user()->role == 2){
        $data->delete();
        return redirect( route('admin.post'))->with('message','Product Removed Successfully');
    }else{
        return redirect( route('access'))->with('message','Access Denied');
    }
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
public function contact(){
    return view('backend.admin.contact');
}
public function index(){
    return redirect()->route('admin.dashboard');
}
public function faq(){
    return view('backend.admin.faq');
}
protected function users(){
    $PostCount = 8;
    $data = User::latest()
    ->paginate($PostCount);
    return view('backend.admin.users',compact('data'))->with('i',(request()->input('page',1)-1)*$PostCount);
}
protected function newuser(){
    return view('backend.admin.newuser');
}

}

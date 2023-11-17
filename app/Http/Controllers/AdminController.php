<?php

namespace App\Http\Controllers;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Helper\BlogController;
use App\Http\Controllers\Helper\CategoryController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    protected function dashboard(){
        return view('backend.admin.dashboard');
    }
    protected function categories(){
       $request = new CategoryController();
       $action = $request->read('backend.admin.categories', 12);
       return $action;
    }
    protected function delete_category($id){
        $user = User::where('id',Auth::user()->id)->first();
        $request = new CategoryController();
        $action = $request->delete($id, $user->role);
        return $action;
    }
    protected function newcategory(){
        $title = 'New Category';
        return view('backend.admin.addcategory',compact('title'));
    }
    protected function updatecategory($id){
        $title = 'New Category';
        $category = Category::where('id', $id)->first();
        $cid = $id;
        return view('backend.admin.addcategory',compact('category','cid','title'));
    }
    protected function storecategory(Request $req){
        $datas = ['cat_name', 'cat_des', 'cat_slug'];
        $request = new CategoryController();
        $action = $request->create($req, $datas);
        return $action;
    }
    protected function posts(){
        $uid = Auth::user()->id;
        $posts = new BlogController();
        $action = $posts->read('backend.admin.posts', 8, null, $uid);
        return $action;

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
        $user_id = Auth::user()->id;
        $datas = ['title','status','slug','tag','description', 'category'];
        $post = new BlogController();
        $action = $post->createOrUpdate($req, $datas, $user_id);
        return $action;
   }
   protected function delete_post($id){
        $user = User::where('id',Auth::user()->id)->first();
        $uid = Auth::user()->id;
        $request = new BlogController();
        $action = $request->delete($id, $uid, $user->role);
        return $action;
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

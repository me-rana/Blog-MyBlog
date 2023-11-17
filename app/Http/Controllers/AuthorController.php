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


class AuthorController extends Controller
{
    //
    protected function dashboard(){
        return view('backend.author.dashboard');
    }
    protected function categories(){
        $categories = new CategoryController();
        $action = $categories->read('backend.author.categories', 8);
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
    protected function posts(){
        $uid = Auth::user()->id;
        $posts = new BlogController();
        $action = $posts->read('backend.author.posts', 8, null, $uid);
        return $action;

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
        $post_id = $id;
        return view('backend.author.addpost',compact('data','title','post','post_id'));
    }
    protected function storepost(Request $req){
        $user_id = Auth::user()->id;
        $datas = ['title','status','slug','tag','description', 'category'];
        $post = new BlogController();
        $action = $post->createOrUpdate($req, $datas, $user_id);
        return $action;
    }
    protected function storecategory(Request $req){
        $datas = ['cat_name', 'cat_des', 'cat_slug'];
        $category = new CategoryController();
        $action = $category->create($req, $datas);
        return $action;
    }
    protected function delete_post($id){
        $user = User::where('id',Auth::user()->id)->first();
        $uid = Auth::user()->id;
        $request = new BlogController();
        $action = $request->delete($id, $uid, $user->role);
        return $action;
        
        
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

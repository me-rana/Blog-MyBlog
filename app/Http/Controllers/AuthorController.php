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
        $post_id = $id;
        return view('backend.author.addpost',compact('data','title','post','post_id'));
    }
    protected function storepost(Request $req){
        $user_id = Auth::user()->id;
        $datas = ['title','status','slug','tag','description', 'category'];
        $post = new BlogController();
        $action = $post->createOrUpdate(route('author.post'), $req, $datas, $user_id);
        return $action;
    }
    protected function storecategory(Request $req){
        $datas = ['cat_name', 'cat_des', 'cat_slug'];
        $category = new CategoryController();
        $action = $category->create($req, $datas);
        return $action;
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

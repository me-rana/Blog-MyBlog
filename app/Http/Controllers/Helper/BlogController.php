<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\FlareClient\View;

class BlogController extends Controller
{ 
    //
    protected function image_store($req_file, $file_location){
        if($req_file != null){
            $img_name = $req_file->getClientOriginalName();
            $image = date("Y-m-d_H-i-s")."_".rand(11111,99999).$img_name;
            $req_file->storeAs($file_location, $image);
            return 'storage/post/'.$image;
        }
    }
    protected function image_delete($file){
        $image_path = $file; 
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        return 0;
    }

    function read($view_file, $perpage, $data){
        $posts = Post::where('status','1')->where('deleted_at',null)->latest()->paginate($perpage);
        return View($view_file, compact('posts'))->with($data)->with('i',(request()->input('page',1)-1)*$perpage);
    }

    function read_one($view_file, $slug, $data){
        $read_one = Post::where('slug', $slug)->where('status',1)->first();
        return view($view_file, compact('read_one'))->with($data);
    }

    function createOrUpdate($request, $datas, $user_id){
        if (is_null($request->post_id)){
            $post = new Post();
            foreach ($datas as $data){
                $post->$data = $request->$data;
            }
            $post->author_id = $user_id;
            $post->updated_by = null;
            if(!is_null($request->file('image'))){
                $post->image_path = $this->image_store($request->file('image'), 'public/post');
            }
            $post->save();
        }
        else{
            $post = Post::where('id',$request->post_id)->first();
            foreach ($datas as $data){
                $post->$data = $request->$data;
            }
            $post->updated_by = $user_id;
            if(!is_null($request->file('image'))){
                $this->image_delete($post->image_path);
                $post->image_path = $this->image_store($request->file('image'), 'public/post');
            }
            $post->update();
        } 
        return redirect()->back()->with('message','Your action is done successfully');
    }
    public function delete($id, $uid, $role){
        $post = Post::where('id', $id)->first();
        if ($post->author_id == $uid || $role == 2){
            $this->image_delete($post->image_path);
            $post->delete();
        }
        return redirect()->back()->with('message', 'The Post deleted successfully.');
    }
}


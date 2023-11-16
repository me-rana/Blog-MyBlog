<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    //
     //Support function for reuse in same class
     protected function image_delete($file){
        $image_path = 'storage/category/'.$file; 
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        return 0;
    }

    protected function image_store($req_file, $file_location){
        if($req_file != null){
            $img_name = $req_file->getClientOriginalName();
            $image = date("Y-m-d_H-i-s")."_".rand(11111,99999).$img_name;
            $req_file->storeAs($file_location, $image);
            return 'storage/category/'.$image;
        }
    }
    
    public function read($view_file, $perpage){
        $data = Category::latest()->paginate($perpage);
        return view($view_file, compact('data'))->with('i',(request()->input('page',1)-1)*$perpage);
    }

    public function read_one($view_file, $slug, $data){
        $category = Category::where('cat_slug', $slug)->first();
        return view($view_file, compact('category'))->with($data);
    }

    public function create($request, $datas){
        $category = new Category();
        foreach ($datas as $data){
            $category->$data = $request->$data;
        }
        if (!is_null($request->file('image'))){
            $category->cat_path = $this->image_store($request->file('image'), 'public/category');
        }
        $category->save();
        return redirect()->back()->with('message','Category added successfully');
    }
}

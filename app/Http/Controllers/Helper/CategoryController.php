<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function read($view_file, $slug, $data){
        $category = Category::where('cat_slug', $slug)->first();
        return view($view_file, compact('category'))->with($data);
    }
}

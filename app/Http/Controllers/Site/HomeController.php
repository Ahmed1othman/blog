<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::with('posts')->get();
        return view('site.pages.home',compact('categories'));
    }

    public function getPosts($id){
        $categories = Category::all();
        $category = Category::with('posts')->find($id);
        return view('site.pages.category',compact('category','categories'));
    }
}

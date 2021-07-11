<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(){
        try {
            $posts= Post::with('createdBy','category')->get();
            return view('admin.pages.posts.index',compact('posts'));
        }catch (\Exception $ex){
            return $ex;
        }

    }
    public function create(){
        try {
            $categories = Category::all();
            return view('admin.pages.posts.create-post',compact('categories'));
            }
            catch (\Exception $ex) {
                return redirect()->route('admin.posts.index')->with('Error','Error, please try again');
            }
    }


    public function store(PostRequest $request){
        try {
            if (!$request->has('state')){
                $request->request->add(['state'=>1]); //active
            }


            DB::beginTransaction();
            $photo_name = '';
            if ($request->has('photo')){
                $file = $request->file('photo');
                $photo_name = $file->getClientOriginalName();
                $photo_name = $photo_name ;
            }

            $post = Post::create([
                'post_title'=>$request->post_title,
                'post_body'=>$request->post_body,
                'admin_id'=>Auth::guard('admin')->user()->id,
                'category_id'=>$request->category_id,
                'state'=>$request->state,
                'photo'=>$photo_name,
            ]);
            if ($post&&$request->has('photo')){
                uploadFile($file,public_path('posts_photos/'),$photo_name);
                DB::commit();
                return redirect()->route('admin.posts.index')->with('Add','post has been added successfully');
            }
            return redirect()->route('admin.posts.index')->with('Error','post has not been added');
        }catch (\Exception $ex){
            DB::rollBack();
            return $ex;
            return redirect()->route('admin.posts.index')->with('Error','An error occurred, please try again later');
        }
    }


}

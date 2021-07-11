<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryRequest;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('createdBy')->get();
        return view('admin.pages.categories.index',compact('categories'));
    }

    public function store(CategoryRequest $request){
        //validation

        //try to store category
        try {
            if (!$request->has('state')){
                $request->request->add(['state'=>1]); //active
            }

            DB::beginTransaction();
            $category = Category::create([
                'name'=>$request->name,
                'admin_id'=>Auth::guard('admin')->user()->id,
                'state'=>$request->state,
            ]);
                if ($category){
                    DB::commit();
                    return redirect()->route('admin.categories.index')->with('Add','category has been added successfully');
                }
                return redirect()->route('admin.categories.index')->with('Error','category has not been added');
            }catch (\Exception $ex){
                DB::rollBack();
                return redirect()->route('admin.categories.index')->with('Error','An error occurred, please try again later');

        }
    }

    public function update(CategoryRequest $request){

        try {
                $category = Category::find($request->id);
                if (!$category){
                    return redirect()->route('admin.categories.index')->with('Error','this category not exists');
                }
                if (!$request->has('state')){
                    $request->request->add(['state'=> '0']); //disable
                }else
                    $request->request->add(['state'=> '1']); //disable
                //return $request;
            DB::beginTransaction();
                $state=$category->update([
                    'name'=>$request->name,
                    'admin_id'=>Auth::guard('admin')->user()->id,
                    'state'=>$request->state,
                ]);
                if ($state){
                    DB::commit();
                    return redirect()->route('admin.categories.index')->with('Add','category has been added successfully');
                }
                return redirect()->route('admin.categories.index')->with('Error','category has not been added');
            }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('admin.categories.index')->with('Error','An error occurred, please try again later');

        }

    }

    public function delete(){
        try {
            DB::beginTransaction();

            if (1){
                DB::commit();
                return redirect()->route('admin.categories.index')->with('Add','category has been added successfully');
            }
            return redirect()->route('admin.categories.index')->with('Error','category has not been added');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('admin.categories.index')->with('Error','An error occurred, please try again later');

        }
    }


}

<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Category::get();
        return view('Dashboard.category.index',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

         $rules = [
            'category_name' => 'required|unique:categories,category_name,NULL,id,deleted_at,NULL',
        ];

        $message = [
                'category_name.required' => trans('superadmin/validation.required'),
                'category_name.required' => trans('superadmin/validation.unique'),
        ];

        $validator = Validator::make($request->all(), $rules, $message);

             $notification = array(
             'message'=>$validator->errors()->first(),
             'alert-type'=>'error'
            );

        if ($validator->fails()) {
            return redirect()->back()->with($notification);
        }
        Category::create($input);
        $notification = array(
             'message'=>'Category Add Successfully',
             'alert-type'=>'success'
        );

        return redirect()->route('view.category')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('Dashboard.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $categoryId = $request->category_id;
        $input = $request->all();

         $rules = [
            'category_name' => 'required',
        ];

        $message = [
                'category_name.required' => trans('superadmin/validation.required'),
                'category_name.required' => trans('superadmin/validation.unique'),
        ];

        $validator = Validator::make($request->all(), $rules, $message);

             $notification = array(
             'message'=>$validator->errors()->first(),
             'alert-type'=>'error'
            );

        if ($validator->fails()) {
            return redirect()->back()->with($notification);
        }
       
        $categoryupdate = Category::findOrFail($categoryId);
        $categoryupdate->update($input);
        $notification = array(
             'message'=>'Category Update Successfully',
             'alert-type'=>'success'
        );

        return redirect()->route('view.category')->with($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        $notification = array(
         'message'=>'Category Delete Successfully',
         'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}

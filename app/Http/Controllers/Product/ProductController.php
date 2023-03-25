<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductFeature;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $products = Product::with('Category','ProductFeature')->get();
        return view('Dashboard.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('Dashboard.product.add',compact('categories'));
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
            'product_name' => 'required|unique:products,product_name,NULL,id,deleted_at,NULL',
        ];

        $message = [
                'product_name.required' => trans('superadmin/validation.required'),
                'product_name.required' => trans('superadmin/validation.unique'),
        ];

        $validator = Validator::make($request->all(), $rules, $message);

             $notification = array(
             'message'=>$validator->errors()->first(),
             'alert-type'=>'error'
            );

        if ($validator->fails()) {
            return redirect()->back()->with($notification);
        }
 
            //Product Color
            // $Productcolor = [];
            // $color_array = [];
            // foreach ($input['product_color'] as $key=>$color) {

            //   $Productcolor[] = $color;
            //   //$color_array[] = $Productcolor;
            // }
            // $color_array = json_encode($Productcolor, true);

            // //Product Size
            // $Productsize = [];
            // $size_array = [];
            // foreach ($input['product_size'] as $key=>$size) {

            //   $Productsize[] = $size;
            //   //$size_array[] = $Productsize;
            // }
            // $size_array = json_encode($Productsize, true);


            $Product  = new Product();
            $Product->category_id = $input['category_id'];
            $Product->product_name = $input['product_name'];
            $Product->product_description = $input['product_description'];
            $Product->product_price = $input['product_price'];
            // $Product->product_color = $color_array;
            // $Product->product_size = $size_array;
            $Product->status = $input['status'];
            $Product->save();

            if ($Product->id) {
                $color_array = array();
                foreach ($input['product_color'] as $key => $entity) {
                    $color_array[] = ['product_id'=>$Product->id,'product_color'=>$entity,'product_size' => $input['product_size'][$key]];
                }
                //dd($color_array);
                ProductFeature::insert($color_array);
            }

            $notification = array(
             'message'=>'Product Add Successfully',
             'alert-type'=>'success'
            );

        return redirect()->route('view.product')->with($notification);


       
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
        $categories = Category::get();
        $product = Product::findOrFail($id);
        $products = Product::with('Category','ProductFeature')->where('id',$id)->first();
        return view('Dashboard.product.edit',compact('categories','product','products'));
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
        $productId = $request->product_id;
        $input = $request->all();


        $Product  = Product::findOrFail($productId);
        $Product->category_id = $input['category_id'];
        $Product->product_name = $input['product_name'];
        $Product->product_description = $input['product_description'];
        $Product->product_price = $input['product_price'];
        $Product->status = $input['status'];
        $Product->save();

        ProductFeature::where('product_id',$productId)->delete();
        if ($Product->id) {
                $color_array = array();
                foreach ($input['product_color'] as $key => $entity) {
                    $color_array[] = ['product_id'=>$Product->id,'product_color'=>$entity,'product_size' => $input['product_size'][$key]];
                }
                //dd($color_array);
                ProductFeature::insert($color_array);
        }

        $notification = array(
         'message'=>'Product Update Successfully',
         'alert-type'=>'success'
        );

      return redirect()->route('view.product')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        $notification = array(
         'message'=>'Product Delete Successfully',
         'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}

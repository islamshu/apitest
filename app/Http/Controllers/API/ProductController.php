<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\ProductResource;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $success= ProductResource::collection(Product::all());
        return $this->sendResponse($success,'this is All Product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "image" => "required",
            "title" => "required",
            "price" => "required",
            "store_id" => "required",

        ]);
        if ($validate -> fails()) {
            $error = $validate->errors();
            return $this->sendError('error validation', $error);
            die();
          }
          if($request->image != null){
              $path = $request->image->store('product_image');
          }
        $product = new Product(
            [
                "image" =>$path,
                "title" =>$request->title,
                "price" =>$request->price,
                "store_id" =>$request->store_id,
            
            ]);
        $product->save();

        $success = new ProductResource($product);
        return $this->sendResponse($success,'Add product Successfuly');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

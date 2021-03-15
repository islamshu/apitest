<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\Http\Resources\StoreResource;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class StoreController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $success= StoreResource::collection(Store::all());
        return $this->sendResponse($success,'this is All Store');
    }
    public function index_home()
    {
        $success= StoreResource::collection(Store::where('is_fetured',1)->inRandomOrder()->take(6)->get());
        return $this->sendResponse($success,'this is All fetured Stores');
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
            "num_product" => "required",
            "num_order" => "required",
            "address" => "required",  
        ]);
        if ($validate -> fails()) {
            $error = $validate->errors();
            return $this->sendError('error validation', $error);
            die();
          }
          if($request->image != null){
              $path = $request->image->store('store_image');
          }
        $store = new Store([
            "image" =>$path,
            "title" =>$request->title,
            "num_order" =>$request->num_order,
            "num_product" =>$request->num_order,
            "address" =>$request->address,
            ]);
        $store->save();

        $success = new StoreResource($store);
        return $this->sendResponse($success,'Add Store Successfuly');
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

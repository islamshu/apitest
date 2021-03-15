<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Professional;
use App\Http\Resources\ProfessionalResource;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class ProfessionalController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $success= ProfessionalResource::collection(Professional::all());
        return $this->sendResponse($success,'this is All professionals');
    }
    public function index_home()
    {
        $success= ProfessionalResource::collection(Professional::where('is_fetured',1)->inRandomOrder()->take(6)->get());
        return $this->sendResponse($success,'this is All fetured professionals');
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
            "phone" => "required",
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
        $professional = new Professional([
            "image" =>$path,
            "title" =>$request->title,
            "num_order" =>$request->num_order,
            "address" =>$request->address,
            "phone" =>$request->phone,
            ]);
        $professional->save();

        $success = new ProfessionalResource($professional);
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

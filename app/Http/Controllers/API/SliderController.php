<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use App\Http\Resources\SliderResource;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class SliderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $success= SliderResource::collection(Slider::all());
        return $this->sendResponse($success,'this is All Store');
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
            "image" => "required"
        ]);
        if ($validate -> fails()) {
            $error = $validate->errors();
            return $this->sendError('error validation', $error);
            die();
          }
          if($request->image != null){
              $path = $request->image->store('slider_image');
          }
        $slider = new Slider(["image" =>$path]);
        $slider->save();

        $success = new SliderResource($slider);
        return $this->sendResponse($success,'Add Slider Successfuly');
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

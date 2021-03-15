<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Prouduct;
class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'image'=>asset('upload/'.$this->image),
            'title'=>$this->title,
            'rate'=>$this->rate,
            'number of productd'=>Product::where('store_id',$this->id)->count(),
            'number of order'=>$this->num_order,
            'is_fetured'=>$this->is_fetured,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

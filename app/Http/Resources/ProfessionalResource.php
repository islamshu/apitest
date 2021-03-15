<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalResource extends JsonResource
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
            'number of order'=>$this->num_order,
            'is_fetured'=>$this->is_fetured,
            'phone'=>$this->phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

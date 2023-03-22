<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;


class TaskCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->description,
            'status'=>$this->status,
            'created'=>$this->created_at
        ];
        //return parent::toArray($request);
    }
}

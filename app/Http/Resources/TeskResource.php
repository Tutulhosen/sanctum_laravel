<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        =>(string)$this->id,
            'attribute' =>[
                'name'          =>$this->name,
                'description'   =>$this->description,
                'priority'      =>$this->priority,
                'create_at'     =>$this->create_at,
                'update_at'     =>$this->update_at,
            ],
            'relationships' =>[
                'id'          =>(string)$this->user->id,
                'user name'   =>$this->user->name,
                'user email'  =>$this->user->email
            ]
        ];
    }
}

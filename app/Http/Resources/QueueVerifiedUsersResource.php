<?php

namespace App\Http\Resources;

use App\Models\Commerce;
use Illuminate\Http\Resources\Json\JsonResource;

class QueueVerifiedUsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($this);
        //$resource = $this->resource;
        //$commerce = $resource->queue;
        //$resource = new CommerceResource($commerce);
        //$commerce = new CommerceResource($this->queue->commerce);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->position,
            'estimated_time' => $this->estimated_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'queue_id' => $this->queue_id,
            'user_id' => $this->user_id,
            //'image' => $commerce->resource->image,
        ];
    }
}

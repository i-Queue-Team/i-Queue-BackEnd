<?php

namespace App\Http\Resources;

use App\Models\Commerce;
use Illuminate\Support\Facades\Storage;
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
        $image = $this->queue->commerce->image ? url('/') . Storage::url('') . 'commerces/' . $this->queue->commerce->image : "https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1650&q=80";
        return [
            'id' => $this->id,
            'name' => $this->queue->commerce->name,
            'position' => $this->position,
            'estimated_time' => $this->estimated_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'queue_id' => $this->queue_id,
            'user_id' => $this->user_id,
            'image' => $image,
        ];
    }
}

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
        return [
            'id' => $this->id,
            'name' => $this->queue->commerce->name,
            'position' => $this->position,
            'estimated_time' => $this->estimated_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'queue_id' => $this->queue_id,
            'user_id' => $this->user_id,
            'image' => $this->queue->commerce->imageUrl(),
        ];
    }
}

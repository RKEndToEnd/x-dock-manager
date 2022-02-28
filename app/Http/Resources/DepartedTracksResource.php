<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartedTracksResource extends JsonResource
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
        'track number'=>$this->track_id,
        'vehicle id'=>$this->vehicle_id,
        'track type'=>$this->track_type,
        'freight'=>$this->freight,
        'departure plan'=>$this->eta,
        'docking plan'=>$this->docking_plan,
        'docked at'=>$this->docked_at,
        'reloading start'=>$this->task_start,
        'reloading end'=>$this->task_end,
        'departure'=>$this->departure,
        'comment'=>$this->comment,
       ];
    }
}

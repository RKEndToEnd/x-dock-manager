<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartedTracksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'trackNumber' => $this->track_id,
            'vehicleId' => $this->vehicle_id,
            'trackType' => $this->track_type,
            'freight' => $this->freight,
            'departurePlan' => $this->eta,
            'dockingPlan' => $this->docking_plan,
            'dockedAt' => $this->docked_at,
            'reloadingStart' => $this->task_start,
            'reloadingEnd' => $this->task_end,
            'departure' => $this->departure,
            'comment' => $this->comment,
        ];
    }
}

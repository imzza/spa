<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RolesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        // return parent::toArray($request);
        // For Parsing
        return [
            'name'       => $this->name,
            'rolename'      => $this->rolename,
            'role_descrip'    => $this->role_descrip
        ];
        // , 'created_at' => Carbon::parse($this->created_at)->toDayDateTimeString(),
    }
}

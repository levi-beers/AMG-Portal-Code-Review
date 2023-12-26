<?php

namespace AMGPortal\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataJetS2SMSResource extends JsonResource
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
            'message' => 'Successfully submitted '.$this->phone_mobile,
        ];
    }
}

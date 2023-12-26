<?php

namespace AMGPortal\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
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
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'dob' => $this->dob,
            'address' => $this->address,
            'city' => $this->city,
            'region' => $this->region,
            'zip' => $this->zip,
            'phone_mobile' => $this->phone_mobile,
            'email_signup_ip' => $this->email_signup_ip,
            'email_signup_url' => $this->email_signup_url,
            'gender' => $this->gender,
            'timestamp' => $this->timestamp
        ];
    }

}

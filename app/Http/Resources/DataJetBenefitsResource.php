<?php

namespace AMGPortal\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataJetBenefitsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     *             'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'dob' => $this->dob,
            'mailing_address' => $this->mailing_address,
            'city' => $this->city,
            'region' => $this->region,
            'zip' => $this->zip,
            'phone_mobile' => $this->phone_mobile,
            'member_id' => $this->member_id,
            'email_signup_ip' => $this->email_signup_ip,
            'email_signup_url' => $this->email_signup_url,
            'email_signup_tstamp' => $this->email_signup_tstamp,
            'sms_signup_ip' => $this->sms_signup_ip,
            'sms_signup_url' => $this->sms_signup_url,
            'sms_signup_tstamp' => $this->sms_signup_tstamp,
            'gender' => $this->gender,
            'homeowner_status' => $this->homeowner_status,
            'employment_status' => $this->employment_status,
            'marital_status' => $this->marital_status,
            'education_level' => $this->education_level,
            'utm_campaign' => $this->utm_campaign,
            'utm_content' => $this->utm_content,
            'utm_medium' => $this->utm_medium,
            'utm_term' => $this->utm_term,
            'utm_group' => $this->utm_group,
            'utm_source' => $this->utm_source
     */
    public function toArray($request)
    {
        return [
            'message' => 'Successfully submitted '.$this->email,
        ];
    }
}

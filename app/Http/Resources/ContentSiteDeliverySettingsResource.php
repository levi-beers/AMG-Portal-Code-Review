<?php

namespace AMGPortal\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentSiteDeliverySettingsResource extends JsonResource
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
            'id' => (int) $this->id,
            'content_site_id' => (int) $this->content_site_id,
            'delivery_domain' => $this->delivery_domain,
            'datasource' => $this->datasource,
            'throttle' => $this->throttle,
            'time_value' => $this->time_value,
            'historic_throttle' => $this->historic_throttle,
            'historic_time_value' => $this->historic_time_value,
            'updated_at' => (string) $this->updated_at,
            'created_at' => (string) $this->created_at,
        ];
    }

}

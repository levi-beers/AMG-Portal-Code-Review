<?php

namespace AMGPortal\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ESPSettingsResource extends JsonResource
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
            'esp_name' => $this->esp_name,
            'esp_description' => $this->esp_description,
            'list_name' => $this->list_name,
            'list_id' => $this->list_id,
            'api_url' => $this->api_url,
            'api_key' => $this->api_key,
            'esp_str_value' => $this->esp_str_value,
            'updated_at' => (string) $this->updated_at,
            'created_at' => (string) $this->created_at,
        ];
    }

}

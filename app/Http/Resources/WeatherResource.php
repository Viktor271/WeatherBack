<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
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
            "id" => $this->id,
            "city" => $this->city,
            "temperature" => $this->temperature,
            "wind" => $this->wind,
            "humidity" => $this->humidity,
            "pressure" => $this->pressure,
            "date" => $this->date,
        ];
    }
}

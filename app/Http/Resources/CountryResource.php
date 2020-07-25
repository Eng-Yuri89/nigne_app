<?php

namespace App\Http\Resources;

use App\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'country_id' => $this->id,
            'country_name' => $this->name,
            'capital' => $this->capital,
            'currency' => $this->currency
        ];
    }


}

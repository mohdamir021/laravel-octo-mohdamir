<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'Movie_ID' => $this->id,
            'Title' => $this->title,
            'Release_Date' => $this->release,
            'Length' => $this->length,
            'Description' => $this->description,
            'MPAA Rating' => $this->mpaa_rating,
            'Genre' => $this->genre,
            'Director' => $this->director,
            'Performer' => $this->performer,
            'Language' => $this->language
        ];
    }
}

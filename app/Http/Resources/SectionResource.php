<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'slug' => $this->slug,
            'image' => $this->image,
            'title' => $this->title,
            'content' => $this->content,
            'seoTitle' => $this->seo_title,
            'seoDescription' => $this->seo_description,
        ];
    }
}

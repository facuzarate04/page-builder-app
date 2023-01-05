<?php

namespace App\Http\Resources\MyPage;

use Illuminate\Http\Resources\Json\JsonResource;

class BlockableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data =  [
            'id' => $this->id,
            'created_at' => $this->created_at,
        ];

        if(get_class($this->resource) === 'App\Models\Page\PageHeader') {
            $data['title'] = $this->title;
            $data['subtitle'] = $this->subtitle;
            $data['avatar'] = $this->avatar;
            $data['banner'] = $this->banner;
            $data['avatar_is_active'] = $this->avatar_is_active;
            $data['banner_is_active'] = $this->banner_is_active;
        }

        if(get_class($this->resource) === 'App\Models\Page\PageSocial') {
            $data['socialLinks'] = $this->whenLoaded('socialLinks');
        }

        if(get_class($this->resource) === 'App\Models\Page\PageLink') {
            $data['linkItems'] = $this->whenLoaded('linkItems');
        }

        return $data;

    }
}

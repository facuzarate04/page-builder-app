<?php

namespace App\Http\Resources\Dashboard;

use App\Http\Resources\MyPage\BlockableResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PageBlockResource extends JsonResource
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
            'id' => $this->id,
            'type' => $this->getType(),
            'order' => $this->order,
            'blockable' => BlockableResource::make($this->whenLoaded('blockable')),
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
        ];
    }

    private function getType()
    {
        switch ($this->blockable_type) {
            case 'App\Models\Page\PageHeader':
                return 'HeaderBlock';
                break;
            case 'App\Models\Page\PageLink':
                return 'LinkBlock';
                break;
            case 'App\Models\Page\PageSocial':
                return 'SocialBlock';
                break;
            default:
                return 'UnknownBlock';
                break;
        }
    }
}

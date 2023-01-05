<?php

namespace App\Models\Page\Links;

use App\Models\Page\PageLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageLinkItem extends Model
{
    use HasFactory;

    protected $table = 'page_link_items';

    protected $fillable = [
        'page_link_id',
        'title',
        'url'
    ];

    public function pageLink()
    {
        return $this->belongsTo(PageLink::class, 'page_link_id');
    }
}

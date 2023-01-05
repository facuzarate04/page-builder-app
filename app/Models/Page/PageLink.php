<?php

namespace App\Models\Page;

use App\Models\Page\Links\PageLinkItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageLink extends Model
{
    use HasFactory;

    protected $table = 'page_links';

    protected $fillable = [
        'page_id'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function block()
    {
        return $this->morphOne(PageBlock::class, 'blockable');
    }

    public function linkItems()
    {
        return $this->hasMany(PageLinkItem::class, 'page_link_id');
    }

}

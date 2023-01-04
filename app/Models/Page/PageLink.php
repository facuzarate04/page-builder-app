<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageLink extends Model
{
    use HasFactory;

    protected $table = 'page_links';

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function block()
    {
        return $this->morphOne(PageBlock::class, 'blockable');
    }

}

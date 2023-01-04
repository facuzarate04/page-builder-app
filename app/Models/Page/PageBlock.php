<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlock extends Model
{
    use HasFactory;

    protected $table = 'page_blocks';

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function blockable()
    {
        return $this->morphTo();
    }
}

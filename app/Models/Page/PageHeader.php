<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageHeader extends Model
{
    use HasFactory;

    protected $table = 'page_headers';

    protected $fillable = [
        'page_id',
        'title',
        'subtitle',
        'avatar',
        'avatar_is_active',
        'banner',
        'banner_is_active'
    ];

    protected $casts = [
        'avatar_is_active' => 'boolean',
        'banner_is_active' => 'boolean',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function block()
    {
        return $this->morphOne(PageBlock::class, 'blockable');
    }
}

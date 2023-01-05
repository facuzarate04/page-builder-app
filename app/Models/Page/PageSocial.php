<?php

namespace App\Models\Page;

use App\Models\Page\Socials\PageSocialLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSocial extends Model
{
    use HasFactory;

    protected $table = 'page_socials';

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

    public function socialLinks()
    {
        return $this->hasMany(PageSocialLink::class, 'page_social_id');
    }
}

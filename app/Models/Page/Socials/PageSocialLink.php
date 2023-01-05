<?php

namespace App\Models\Page\Socials;

use App\Models\Page\PageSocial;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSocialLink extends Model
{
    use HasFactory;

    protected $table = 'page_social_links';

    protected $fillable = [
        'platform_id',
        'page_social_id',
        'username'
    ];

    public function pageSocial()
    {
        return $this->belongsTo(PageSocial::class, 'page_social_id');
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }
}

<?php

namespace App\Models;

use App\Models\Page\Socials\PageSocialLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $table = 'platforms';

    protected $fillable = [
        'name',
        'icon',
        'url'
    ];

    public function socialLinks()
    {
        return $this->hasMany(PageSocialLink::class);
    }
}

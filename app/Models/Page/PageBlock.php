<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlock extends Model
{
    use HasFactory;

    protected $table = 'page_blocks';

    protected $fillable = [
        'page_id',
        'blockable_id',
        'blockable_type',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function blockable()
    {
        return $this->morphTo();
    }

    /* Scopes */

    public function scopeHeaderBlock($query)
    {
        return $query->where('blockable_type', PageHeader::class);
    }

    public function scopeLinkBlock($query)
    {
        return $query->where('blockable_type', PageLink::class);
    }

    public function scopeSocialBlock($query)
    {
        return $query->where('blockable_type', PageSocial::class);
    }

}

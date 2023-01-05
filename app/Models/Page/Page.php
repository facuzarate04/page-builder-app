<?php

namespace App\Models\Page;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $casts = [
        'is_active' => 'boolean',
    ];
    

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function blocks()
    {
        return $this->hasMany(PageBlock::class, 'page_id');
    }
    
}

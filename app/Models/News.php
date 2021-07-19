<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Image(): HasMany
    {
        return $this->hasMany('\App\Models\Image');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function News(): BelongsTo
    {
        return $this->BelongsTo('\App\Models\News');
    }
}

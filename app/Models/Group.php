<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Group extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    /**
     *  Group may assign many users.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('\App\Models\User');
    }

    public function getUsersName(): Collection
    {
        return $this->users->pluck('name');
    }
}

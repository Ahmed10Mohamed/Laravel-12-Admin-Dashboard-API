<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['locale', 'name', 'isActive'];

    public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('isActive', operator: true);
    }
}

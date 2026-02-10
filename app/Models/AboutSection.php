<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AboutSection extends Model
{
    use HasFactory,Translatable;

    public $translatedAttributes = ['title', 'description'];

    protected $fillable = ['image', 'linkVideo', 'position'];

    public function translations(): HasMany
    {
        return $this->hasMany(aboutSectionTranslation::class, 'about_section_id');
    }

    public function translation(): HasOne
    {
        return $this->hasOne(aboutSectionTranslation::class)->where('locale', app()->getLocale());
    }
}

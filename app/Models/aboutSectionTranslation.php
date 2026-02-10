<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class aboutSectionTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title', 'description', 'about_section_id', 'locale'];

    public function aboutSection(): BelongsTo
    {
        return $this->belongsTo(AboutSection::class);
    }
}

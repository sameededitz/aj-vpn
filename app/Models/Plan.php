<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Plan extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'bundle_id',
        'name',
        'slug',
        'description',
        'price',
        'duration',
    ];
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function promoCodes()
    {
        return $this->hasMany(PromoCode::class);
    }
}

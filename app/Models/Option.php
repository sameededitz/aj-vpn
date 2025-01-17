<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Option extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['key', 'value'];

    protected $appends = ['info_img_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('info_img')
            ->useDisk('media')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/bmp']);
    }

    public function getInfoImgUrlAttribute()
    {
        $media = $this->getFirstMedia('info_img');
        return $media ? $media->getUrl() : null;
    }
}

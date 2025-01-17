<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Server extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name', 'status'];

    protected $appends = ['server_logo_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('server_logo')
            ->useDisk('media')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/bmp']);
    }

    public function getServerLogoUrlAttribute()
    {
        $media = $this->getFirstMedia('server_logo');
        return $media ? $media->getUrl() : null;
    }

    public function subServers()
    {
        return $this->hasMany(SubServer::class, 'server_id');
    }
}

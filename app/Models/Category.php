<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;
    protected $fillable = ['name', 'slug', 'description', 'image', 'active'];
    public function products() {
        return $this->belongsToMany(Product::class); // category belongs to many products
    }

    public function registerMediaCollections(): void // register media collections for the category model
    {
        $this->addMediaCollection('image')->singleFile();
    }
}

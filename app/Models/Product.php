<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected  $table = 'product';
    protected $primaryKey = 'product_id';
    protected $fillable =
    [ 'product_id',
    'name',
    'icon_link',
    'system_cover_image',
    'user_manual',
    'video',
    'cost_saving',
    'category_id',
    'image',
    'status_id',
    'number_of_clicks',
    'url',
    'test_url',
    'lead_developer',
    'short_description',
    'long_description',
    'tutorial_url',
    'date_launched',
    'date_decommissioned'];
    public $timestamps = TRUE;

}

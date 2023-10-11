<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{

    use HasFactory;
    use SoftDeletes;

    public $timestamps = TRUE;
    protected $table = 'product';
    protected $fillable =
        [
            'name',
            'icon_link',
            'system_cover_image',
            'user_manual',
            'video',
            'cost_saving',
            'category_id',
            'short_description',
            'long_description',
            'image',
            'market_value',
            'project_cost',
            'dev_launch_date',
            'status_code',
            'heart_beat',
            'number_of_clicks',
            'url',
            'test_url',
            'lead_developer',
            'tutorial_url',
            'date_launched',
            'date_decommissioned',

            'prod_ip_address',
            'test_ip_address',
            'dr_ip_address',
            'public_ip_address',


        ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_code', 'code');
    }

    public function leadDeveloper()
    {
        return $this->belongsTo(User::class, 'lead_developer');
    }

    public function developers()
    {
        return $this->belongsToMany(User::class, 'products_users');
    }

}

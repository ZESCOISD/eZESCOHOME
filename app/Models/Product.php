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
            'cost_saving',
            'category_id',
            'short_description',
            'long_description',
            'image',
            'market_value',
            'project_cost',
            'status_code',
            'heart_beat',
            'number_of_clicks',

            'user_manual',
            'video',
            'url',
            'test_url',
            'tutorial_url',

            'lead_developer',
            'date_launched',
            'dev_launch_date',
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

    public function contactGroups()
    {
        return $this->belongsToMany(ContactGroup::class, 'contact_group_to_product');
    }

}

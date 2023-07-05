<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductClicks extends Model
{
    use HasFactory;
    protected $table = 'product_clicks';
    protected $primarykey = 'id';
    protected $fillable = ['id','product_url','product_name','product_id','number_of_clicks'];
    public $timestamps = TRUE;
}

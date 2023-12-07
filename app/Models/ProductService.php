<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $table = "product_service";

    protected $primarykey = 'id';
    protected $fillable = [
        'product_name',
        'url',
        'status',
        'reason', 
        'product_id', 
        'heart_beat',
        'status_resolved_time', 
        'resolution_comment', 
        'updated_by' 
    ];
    public $timestamps = TRUE;
    use HasFactory;


}

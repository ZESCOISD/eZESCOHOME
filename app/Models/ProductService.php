<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $table = "product";

    protected $primarykey = 'id';
    protected $fillable = ['id','url','status','reason'];
    public $timestamps = TRUE;
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected  $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status_id',
        'id',
        'description',
        'html',
        'name'
    ];
    public $timestamps =true;


    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id') ;
    }
}

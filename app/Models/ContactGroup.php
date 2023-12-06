<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'contact_group';
    protected $fillable = [
        'name',
        'description',
        'location',
        'office_address',
        'email',
        'phone',
    ];

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'contact_group_to_product');
    } 
   
}

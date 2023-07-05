<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected  $table = 'status';
    protected $primaryKey = 'status_id';
    protected $fillable =['status_id','name'];
    public $timestamps =true;
}

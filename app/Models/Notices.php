<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
    use HasFactory;
    protected $table = 'notices';
    protected $primaryKey = 'id';
    protected $fillable = ['notice_name','description','staff_name','staff_title','department','start_date','end_date'];
    public $timestamps =true;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingEvents extends Model
{
    use HasFactory;

    protected  $table = 'upcoming_events';
    protected $primaryKey = 'id';
    protected $fillable =['event_name','event_description','venue','time','date','start_date','end_date'];
    public $timestamps =true;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionBox extends Model
{
    use HasFactory;
    protected $table = 'suggestion_box';
    protected $primaryKey = 'id';
    protected $fillable = ['subject','system_name','suggestion'];
    public $timestamps = true;
}

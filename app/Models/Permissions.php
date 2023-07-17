<?php

namespace App\Models;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['name','guard_name','slug'];
    public $timestamps =true;

    // public function permissions()
    // {
    //     return $this->morphToMany(Permission::class, 'model', 'model_has_permissions');
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;
    protected  $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable =['id','name','guard_name','slug'];
    public $timestamps = TRUE;

    //  public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class, 'role_has_permissions');
    // }

}

<!-- 
use App\Models\User;
use App\Models\Roles;

public function roles(){

return $this->belongsToMany(Roles::class,'roles_permissions');
    
}

public function users() {

return $this->belongsToMany(User::class,'users_permissions');
    
} -->

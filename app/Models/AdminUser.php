<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    protected $table = 'admin_users';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
        'username', 'password', 'name', 'avatar',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, config('admin.database.role_users_table'), 'user_id', 'role_id')->withTimestamps();
    }
}

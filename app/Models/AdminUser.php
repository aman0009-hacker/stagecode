<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Yard;
use Illuminate\Notifications\Notifiable;

// Use App\Models\AdminUser;

class AdminUser extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'admin_users';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'password',
        'name',
        'avatar',
    ];

    public function records()
    {
        return $this->hasMany(Records::class, 'supervisor_id', 'id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function roles()
    {
        return $this->belongsToMany(Role::class, config('admin.database.role_users_table'), 'user_id', 'role_id')->withTimestamps();
    }



    public function yards()
    {
        return $this->hasMany(Yard::class, 'supervisorid', 'id');
    }


    public function notification()
    {
        return $this->hasMany(notification::class, 'notifiable_id', 'id');
    }
}
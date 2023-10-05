<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class Role extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;

    protected $table = 'admin_roles';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function users()
    {
        return $this->belongsToMany(AdminUser::class, config('admin.database.role_users_table'), 'role_id', 'user_id')->withTimestamps();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permisssion\Traits\HasRoles;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;


class Records extends Model
{
    use LogsActivity;
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $table = "supervisor_records";
    use HasFactory;

    //new code for logActivity start
    protected static $logAttributes = ["supervisor_id", "product", "quantity", "created_at"];
    protected static $logOnlyDirty = true;
    protected static $logName = 'yard records';
    protected static $recordEvents = ["created", "updated", "deleted"];
    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults();

        $logOptions->logAttributes = static::$logAttributes;
        $logOptions->logOnlyDirty = static::$logOnlyDirty;
        $logOptions->logName = static::$logName;
        // The getDescriptionForEvent method allows you to customize the description of logged events.
        // It is defined in your User model, and here's how you can use it:
        // $logOptions->setDescriptionForEvent(function (string $eventName) {
        //     return "you have {$eventName} user";
        // });
        return $logOptions;
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "you have {$eventName} yard records";
    }
    //new code for logActivity start 

    public function adminUser()
    {
        return $this->belongsTo(AdminUser::class, 'supervisor_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });

    }


}
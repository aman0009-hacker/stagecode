<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permisssion\Traits\HasRoles;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
Use App\Models\AdminUser;

class Yard extends Model
{
    use HasFactory, LogsActivity;
    public $incrementing = false;
    protected $keyType = 'string';


    //new code for logActivity start
    protected static $logAttributes = ["yardstate", "yardcity", "yardplace", "supervisorid"];
    protected static $logOnlyDirty = true;
    protected static $logName = 'yards';
    protected static $recordEvents = ["created", "updated", "deleted"];
    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults();
        $logOptions->logAttributes = static::$logAttributes;
        $logOptions->logOnlyDirty = static::$logOnlyDirty;
        $logOptions->logName = static::$logName;
        return $logOptions;
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "you have {$eventName} yards";
    }
    //new code for logActivity start 

    public function supervisor()
    {
        return $this->belongsTo(AdminUser::class, 'supervisorid', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}
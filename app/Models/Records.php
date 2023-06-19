<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    public $timestamps = true;
    protected $table="supervisor_records";
    use HasFactory;


}

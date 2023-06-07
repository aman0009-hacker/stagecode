<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    public $timestamps = true;


    public function __toString()
{
    return $this->name;
}

// public function __toString()
// {
//     return $this->getAttribute('name');
// }
    
}
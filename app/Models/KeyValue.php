<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyValue extends Model
{
    public $timestamps = false;

    protected $fillable = ['key', 'value', 'timestamp'];
}

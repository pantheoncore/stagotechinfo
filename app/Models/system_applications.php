<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class system_applications extends Model
{
    use SoftDeletes, HasApiTokens;

    protected $fillable = [
        'system_id',
        'name',
        'version'
    ];
}

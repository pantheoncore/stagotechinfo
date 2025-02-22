<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class systems extends Model
{
    use SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name',
        'image_url',
        'desc'
    ];
}

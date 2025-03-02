<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class systems extends Model
{
    use SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name',
        'image_url',
        'desc',
        'os'
    ];

    /**
     * defines the JSON column types
     *
     * @var array
     */
    protected $casts = [
        'os'=> AsArrayObject::class
    ];

     /**
     * defines the JSON columns default values
     *
     * @var array
     */
    protected $attributes = [
        "os"=> '{
            "name": "",
            "version":  ""
        }'
    ];
}

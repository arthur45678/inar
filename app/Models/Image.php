<?php

namespace App\Models;

use Composer\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Image extends BaseModel
{


    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'name'
    ];


    public function imageable()
    {
        return $this->morphTo();
    }




}

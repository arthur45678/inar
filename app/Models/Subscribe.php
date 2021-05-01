<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Models\ImageOptimization;
use \Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;

class Subscribe extends Model
{
    protected $table = 'subscribes';
    protected $fillable = ['email'];
}

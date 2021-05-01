<?php

namespace App\Models\Pages;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;
class Employeedepartment extends BaseModel
{
    use HasTranslations;
    protected $table = 'employeedepartments';
    protected $fillable = ['name'];
    protected $translatable = ['name'];

    public function aboutUs()
    {
        return $this->hasMany(Aboutus::class,'department_id','id');
    }

    public function teams()
    {
        return $this->hasMany(Aboutus::class,'department_id','id');
    }

}

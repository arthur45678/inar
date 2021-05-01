<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;


class Settings extends BaseModel
{
    protected $table = 'settings';

    /*
     * $data[$localeCode] - $group[] - for multilanguage - lang code
     * Store key value
     */
    public static function storeMultilanguageSettings($data)
    {
        unset($data['_token']);
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            // check, has group (group - for this anguage code)
            if (isset($data[$localeCode])){
                foreach ($data[$localeCode] as $key => $value) {
                    settings()->group($localeCode)->set($key, $value);
                }
            }
        }

    }



}

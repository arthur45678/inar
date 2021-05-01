<?php

namespace App\Models;

use App\Enums\PostsEnum;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Config;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;

class InvestorCompany extends BaseModel
{
    protected $table = 'investor_companies';
    protected $fillable = ['user_id', 'company_name', 'program_name', 'company_address', 'company_phone_1', 'company_phone_2'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /*public static function storeCompany($request, $user_id)
    {
        $input = $request->only($this->fillable);

        $input['user_id'] = $user_id;
        $item = new static();
        $item->fill($input);
        $item->save();
        return $item;
    }*/

    public function updateCompany(Request $request,$id)
    {
        $item = self::findOrFail($id);
        $input = $request->only($this->fillable);
        return $item->update($input);

    }



}

<?php

namespace App\Models;

use App\Enums\PostsEnum;
use App\Models\Pages\Aboutus;
use App\Models\Pages\Buisnessenvioirments;
use App\Models\Pages\Pageinnovation;
use App\Models\Pages\Pagequality;
use App\Models\Pages\Pagesimple;
use App\Models\Pages\Pagesimple2;
use App\Models\Pages\Pagetalent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use LanguageDetection\Language;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Searchable\ModelSearchAspect;
use Illuminate\Support\Facades\App;

class Search extends BaseModel
{

    public static function search($search_text)
    {
        return $searchResults = (new \Spatie\Searchable\Search())
            ->registerModel(Post::class, function(ModelSearchAspect $modelSearchAspect){
                $modelSearchAspect
                    ->addSearchableAttribute('name')
                    ->addSearchableAttribute('text')
                    ->where('posts_type', PostsEnum::article())
                    ->orWhere('posts_type', PostsEnum::pagesPosts());
            })
            ->registerModel(Pagesimple::class, ['name','text_top','text_middle','text_bottom',])
            ->registerModel(Pagesimple2::class, ['name','text_top','text_middle','text_bottom',])
            ->registerModel(Buisnessenvioirments::class, ['name','text_top','text_bottom',])
            ->registerModel(Pageinnovation::class, ['name','text_top','text_middle_left','text_middle_right','text_bottom',])

            ->registerModel(Pagetalent::class, ['name','text_top','text_middle','text_bottom',])


          //  ->registerModel(User::class, ['f_name','l_name'])   // single page no
        //    ->registerModel(Aboutus::class, ['f_name','l_name','short_desc','email'])  // single page no
            //   ->registerModel(Boardoftrusteesteam::class, ['f_name','l_name','short_desc',])
          //

            //
            //   ->registerModel(Manager::class, ['f_name','l_name',])
          //
         //   ->registerModel(Pagequality::class, ['name','text_top','text_bottom',])

         //
          //
         //
            ->search($search_text);
    }

    /*
     * Spatie Searchable Json-ով բազմալեզու սայտում որ պոիսկի ռեսուլտատները ճիշտ գտնված լեզվեվ երևացնելու համար էս ֆունկցիան վերադարձնումա
     * լեզվի ցոդը
     * */
    public static function detectSearchResultLanguage($searchResult, $search_text)
    {

        $langCodes = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $langCodes[] = $localeCode;
        }
        $ld = new Language(['hy','en','ru']);
        $langArray = $ld->detect($search_text)->blacklist()->limit(0, 1)->close();

        foreach ($langArray as $key=> $item) {
            return $key;
        }

    }


    public static function searchResultShortText($text) {
        $text_without_tags = strip_tags($text);
        return $short_text = Str::limit($text_without_tags,100);

    }



}

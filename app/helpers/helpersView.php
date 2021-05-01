<?php
use App\Models\ImageOptimization;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

function viewSiteTitle($name = false){
    $site_title = Setting::where(['key' => 'site_title'])->first()->value;
    if($name == false) return $site_title;
    else return $site_title . ' : ' .$name;
}

function presentDate($date)
{
    return Carbon::parse($date)->format('M d, Y');
}

function showDateWithMonthName($date_at){
    return Carbon::parse($date_at)->format('d M');
}


function showTranslationsNameAllLanguage($item, $fieldName){
    $str = '';
    foreach ($item->getTranslations($fieldName) as $translation) {
       $str .= $translation . ' | ';
    }
    return trim($str, '|');
}

function showImage($img){

   return  isset($img) ?  asset('storage/images') . '/'. $img : asset('imagesServe') . '/no_image.jpg';
}

function showForAdminPageImage($img){

    return  isset($img) ?  asset('storage/images') . '/'. $img : asset('imagesServe') . '/no_image.jpg';
}


function showAvatar($img = null){
    return  isset($img) ?  asset('storage/images') . '/'. $img : asset('asset/site/css/icons-images/avatar.png');
}


function getFile($file){

    return  isset($file) ?  asset('storage/files') . '/'. $file : false;
}


function getAppNameLocale() {
    return settings()->group(App::getLocale())->get('site_title');
}

function getMetaTitle($title){
    if(isset($title)){
        return settings()->group(App::getLocale())->get('site_title') . ' ' .getAppNameLocale();
    }else {
        return settings()->group(App::getLocale())->get('site_title') . ' ' .getAppNameLocale();
    }
}



function viewChartPosition($chartable_type){

    switch ($chartable_type) {
        case \App\Models\Chart::POSITION_TOP:
            echo 'Վերև';
            break;
        case \App\Models\Chart::POSITION_BOTTOM:
            echo 'Ներքև';
            break;
        default:
            echo false;
    }
}


function viewChartPositionSelect($chartable_type = false){
    if(isset($chartable_type)){
        echo '<option '.
        isset($chartable_type) && $chartable_type == \App\Models\Chart::POSITION_TOP  ? 5 : "selected" .'
          value="'.\App\Models\Chart::POSITION_TOP.'">Վերև</option>';

        echo '<option .'.isset($chartable_type) && $chartable_type == \App\Models\Chart::POSITION_TOP  ? 5 : '.
         selected value="'.\App\Models\Chart::POSITION_BOTTOM.'">Ներքև</option>';
    }else {
        echo '<option  value="'.\App\Models\Chart::POSITION_TOP.'">Վերև</option>';
        echo '<option  value="'.\App\Models\Chart::POSITION_BOTTOM.'">Ներքև</option>';
    }
}

function buildTree($items)
{
    $grouped = $items->groupBy('parent_id');
    foreach ($items as $item) {
        if ($grouped->has($item->id)) {
            $item->children = $grouped[$item->id];
        }
    }
    return $items->where('parent_id', null);
}


function selectNestedEdit($tree,  $r = 0, $p = null, $post_id, $post = false){
    /*Test*/
    echo '<pre>';  print_r($post_id); echo '</pre>'; exit();

    /*Testend*/
    foreach ($tree as $key => $item){
        $dash = ($item['parent_id'] == 0) ? '' : str_repeat('-', $r) .' ';

        if ($post_id == $item['id']){
            continue;
        }

        $title = $item['name'];

        if($post->parent_id == $item['id']){
            echo '<option  selected="selected" value="'. $item['id'] .'">'. $dash .''. $title .'</option>';
        }else{
            echo '<option  value="'. $item['id'] .'">'. $dash .''. $title .'</option>';
        }

        if($item['parent_id'] == $p){
            $r = 0;
        }

        if(isset($item->children)){
            selectNestedEdit($item->children, $r+1, $item['parent_id'], $post_id, $post);
        }
    }
}


function object_to_array($object) {
    if (is_object($object)) {
        return array_map(__FUNCTION__, get_object_vars($object));
    } else if (is_array($object)) {

        return array_map(__FUNCTION__, $object);
    } else {
        return $object;
    }
}



function highlightTerms($text_string, $terms){
    $words = explode(' ',$terms);

    ## We can loop through the array of terms from string
    foreach ($words as $term)
    {
        ## use preg_quote

        $term = preg_quote($term);

        ## Now we can  highlight the terms

        $text_string = preg_replace("/\b($term)\b/i", '<span class="hilitestyle">\1</span>', $text_string);

    }

    ## lastly, return text string with highlighted term in it
    return  $text_string;
}

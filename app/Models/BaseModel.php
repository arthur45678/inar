<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\Searchable\Searchable;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Config;
use Spatie\Translatable\HasTranslations;


class BaseModel extends Model
{

    protected $extensions = ['Restore', 'WithTrashed', 'WithoutTrashed', 'OnlyTrashed'];



    public function storeFile($request)
    {
        if(isset($request->delete_file)){
            $this->file = null;
        }

        $path = storage_path('app/public/files');
        if(!file_exists($path) ){
            mkdir($path, 0777, true);
        }

        if($request->hasFile('file') && $request->file->isValid()){
            $file = $request->file;
            $str = Str::random(8);
            $name = $str.'_' . $file->getClientOriginalName();
            $file->move($path, $name);
            $this->file = $name;
        }
        $this->save();

    }

    /**
     * Images optimizations method
     */



    public function storeImages($request,  $height, $width)
    {
        // Create images
        $images_create = $request->images_create;
        if(isset($images_create) && count($images_create) > 0){
            foreach ($images_create as $image) {
                $image_name = ImageOptimization::imageCropSave($image, $height, $width, storage_path('app/public/images'));
                $this->images()->create(['name' => $image_name]);
            }
        }

        // Update images
        $images_upd = $request->images_update;
        if (isset($images_upd) and (count($images_upd) > 0)){
            foreach($images_upd as $key => $image) {
                if(isset($key)){
                    $img_upt = $this->images()->where('name', $key)->first();
                    $image_name = ImageOptimization::imageCropSave($images_upd[$key], $height, $width, storage_path('app/public/images'));
                    $img_upt->name = $image_name;
                    $img_upt->save();
                }

            }
        }

        // Delete images
        $images_del = $request->images_delete;
        if (isset($images_del) and (count($images_del) > 0)){
            foreach($images_del as $key => $image) {
                if(isset($key)){
                    $img_upt = $this->images()->whereId($key)->first();
                    $img_upt->delete();
                }

            }
        }
    }


    public function addVYoutubeLinks($input = [])
    {

        $videos_create = $input['videos_create'];
        $videos_create_name = $input['videos_create_name'];
        $videos_create = array_slice($videos_create, 0, null);

        if (count(array_filter($videos_create))) {
            foreach ($videos_create as $key => $referring) {
                if (isset($referring) && isset($key)) {
                    Video::create(
                        [
                            'youtube_link' => $referring,
                            'videoable_type' => get_class($this),
                            'name' => $videos_create_name[$key],
                            'videoable_id' => $this->id,
                        ]
                    );
                }
            }
        }

        return $this;
        /*Testend*/


        // Create videos
        $videos_create = $request->videos_create;
        if(isset($videos_create) && count($videos_create) > 0){
            foreach ($videos_create as $video_url) {
                if(isset($video_url)){
                    $this->videos()->create(['youtube_link' => $video_url]);
                }
            }
        }

        // Update videos
        $videos_upd = $request->videos_update;
        if (isset($videos_upd) and (count($videos_upd) > 0)){
            foreach($videos_upd as $key => $video) {

                if(isset($key)){
                    $video_upt = $this->videos()->where('youtube_link', $key)->first();
                    $video_upt->name = $video_name;
                    $video_upt->save();
                }

            }
        }

        // Delete videos
        $videos_del = $request->videos_delete;
        if (isset($videos_del) and (count($videos_del) > 0)){
            foreach($videos_del as $key => $video) {
                if(isset($key)){
                    $video_upt = $this->videos()->whereId($key)->first();
                    $video_upt->delete();
                }

            }
        }
    }



    public static function transliterate($aliasName = false)
    {
        $alias = null;
        if(empty($aliasName)){
            $alias = (int) microtime(true);
        }elseif ($aliasName){
            /*Begin */
            // $alias = self::transliterate($aliasName);

            $str = mb_strtolower($aliasName, 'UTF-8');

            $letter_array = array(
                'a' => 'а,ա',
                'b' => 'б,բ',
                'v' => 'в,վ',
                'g' => 'г,ґ,գ',
                'h' => 'հ',
                'd' => 'д, դ',
                'dz' => 'ձ',
                'e' => 'е,є,э,ե,է',
                'ev' => 'և',
                'jo' => 'ё',
                'zh' => 'ж,ժ',
                'z' => 'з,զ',
                'i' => 'и,і,ի',
                'ji' => 'ї',
                'j' => 'й,յ,ջ',
                'k' => 'к,կ',
                'l' => 'л,լ',
                'm' => 'м,մ',
                'n' => 'н,ն',
                'o' => 'о,ո,օ',
                'p' => 'п,պ,փ',
                'r' => 'р,ռ,ր',
                's' => 'с,ս',
                't' => 'т,թ,տ',
                'u' => 'у,ւ',
                'f' => 'ф,ֆ',
                'kh' => 'х,խ,ղ',
                'ts' => 'ц,ծ,ց',
                'ch' => 'ч,ճ,չ',
                'sh' => 'ш,շ',
                'shch' => 'щ',
                '' => 'ъ,ը',
                'y' => 'ы',
                '' => 'ь',
                'q' => 'ք',
                'yu' => 'ю',
                'ya' => 'я',
                ' ' => '',
            );

            foreach($letter_array as $leter => $kyr) {
                $kyr = explode(',',$kyr);

                $str = str_replace($kyr,$leter, $str);

            }

            //  A-Za-z0-9-
            $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/','-',$str);

            $str = trim($str,'-');
            /*end*/
            $alias = mb_strimwidth($str, 0, 40);
        }
        return $alias;
    }


    /*
     * Որ հայերեն տեքստը բազայում պահվի նոռմալ տեքստ:
     * Հայերեն ու մյուս ոչ լատին ու կիրիլից լեզուները JSON-ով բազայում թարգմանությունը պահվումա UTF-ի համարը,
     * Դա խնդիրա առաջացնում որոնման ժամանակ:
     */
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }


    /*
     * Spatie laravel laravel-sluggable package պիտի ինստալլ եղաց լինի:
     * Սա ստեղծվածա, որ բազմալեզու սայտերի դեպքում առաջի լեզվով լրացված էլեմենտը սարքի  սլագի պարամետր:
     * string, or assoc array
     */
    public function setSlug($slugParam)
    {
        if(!$this->slug){
            $slugOption = new SlugOptions();
            $slugName = '';
            if(is_array($slugParam)){
                foreach ($slugParam as $key => $value) {
                    if(isset($value)){
                        $slugName = $slugOption->generateSlugsFrom($value);
                        break;
                    }
                }
            }else{
                $slugName = $slugOption->generateSlugsFrom((string) $slugParam);
            }
            $this->slug = $slugName;
            $this->save();
            return $this;
        }
        return $this;
    }


    public function addChart($input = [])
    {
        if(isset($input['charts_post'])){
            $charts = $input['charts_post'];
            $charts_post_position = $input['charts_post_position'];
            $charts_post = array_slice($charts, 0, null);

            if (count(array_filter($charts_post))) {
                foreach ($charts_post as $key => $referring) {
                    if (isset($referring) && isset($key) && isset($charts_post_position[$key])) {

                        $chartable = Chartable::where(['chartable_type' => get_class($this), 'chart_id' => $referring,])->first();
                        if($chartable){
                            $chartable->delete();
                        }

                        Chartable::create(
                            [
                                'chartable_type' => get_class($this),
                                'chart_id' => $referring,
                                'post_position' => $charts_post_position[$key],
                                'chartable_id' => $this->id,
                            ]
                        );
                    }
                }
            }
            return $this;
        }
    }






}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Http\Request;
use DB;
use Hash;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Support\Facades\App;

class User extends Authenticatable  implements Searchable
{
    use Notifiable, HasRoles;
    protected $fillable = [
        'f_name','l_name','type','img','phone_1','phone_2','email', 'password','manager_id',
    ];

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    public const TYPE_ADMIN = 'admin';
    public const TYPE_INVESTOR = 'investor';

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.users.index', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
           $this->f_name . ' ' .$this->l_name,
            $url
        );
    }


    public function messages()
    {
        return $this->hasMany(Notification::class,'receiver_id','id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }


    public function investor_company()
    {
        return $this->hasOne(InvestorCompany::class, 'user_id', 'id');
    }

    public function getStatus($status)
    {
        switch ($status) {
            case self::STATUS_WAIT:
                echo self::STATUS_WAIT;
                break;
            case self::STATUS_ACTIVE:
                echo self::STATUS_ACTIVE;
                break;
            default:
                echo false;
        }
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class,'manager_id','id');
    }


    public function storeInvestor(Request $request)
    {
        $input = $request->only($this->fillable);
        $input['password'] = Hash::make($input['password']);
        $input['type'] = User::TYPE_INVESTOR;

        $item = $this->fill($input);
        $this->save();
        return $this;
    }

    public function updateInvestor(Request $request, $id)
    {
        $item = self::findOrFail($id);
        $input = $request->only($this->fillable);
        $input['type'] = User::TYPE_INVESTOR;


        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
       $item->fill($input);
       $item->save();
       return $item;

    }

    public function storeImage($request)
    {
        if ($request->hasFile('img')) {
        //    $this->img = ImageOptimization::imageCropSave($request->img, 400, 300, storage_path('app/public/images'));
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,  storage_path('app/public/images'));
            $this->save();
        }
    }

}




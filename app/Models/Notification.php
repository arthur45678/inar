<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Notification extends BaseModel
{
    protected $table = 'notifications';
    protected $fillable = ['sender_id', 'receiver_id', 'name', 'text',];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public static function storeMessages($input)
    {
        if (isset($receivers) && empty($input['send_all_investor'])) {
            //   if(isset($receivers) && empty())
            $receivers = $input["receivers"];
            foreach ($receivers as $receiver) {
                $data['sender_id'] = Auth::user()->id;
                $data['receiver_id'] = $receiver;
                $data['name'] = $input['name'];
                $data['text'] = $input['text'];
                self::create($data);
            }

        }
        if (isset($input['send_all_investors'])) {
            $receivers = User::where(['type' => User::TYPE_INVESTOR])->get();

            foreach ($receivers as $receiver) {
                $data['sender_id'] = Auth::user()->id;
                $data['receiver_id'] = $receiver->id;
                $data['name'] = $input['name'];
                $data['text'] = $input['text'];
                self::create($data);
            }
        }



    }
}

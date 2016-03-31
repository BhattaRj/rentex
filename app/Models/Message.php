<?php

namespace App\Models;

use Auth;

class Message extends BaseModel
{
    protected $table    = "messages";
    protected $fillable = ['message', 'sender_id', 'recever_id', 'title', 'phone', 'email', 'fullname', 'status'];
    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id', 'id');
    }
    public function recever()
    {
        return $this->belongsTo('App\Models\User', 'recever_id', 'id');
    }

    public function myMessage()
    {
        $query = $this->where('recever_id', Auth::id())->with(['sender' => function ($query) {
            $query->addSelect('username', 'id', 'profile_pic');
        }])->groupBy('sender_id')->orderBy('created_at')->get();
        return $query;
    }

    public function getConversation($sender_id)
    {
        $query = $this->where(function ($query) use ($sender_id) {
            $query->where('sender_id', $sender_id)->orWhere('sender_id', Auth::id());
        })->where(function ($query) use ($sender_id) {
            $query->where('recever_id', $sender_id)->orWhere('recever_id', Auth::id());
        })->with('sender', 'recever');
        return $query;
    }
}

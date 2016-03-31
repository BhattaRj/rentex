<?php

namespace App\Models;

use Auth;

class Shortlist extends BaseModel
{

    protected $table    = "shortlists";
    protected $fillable = ['user_id', 'shortlistable_type', 'shortlistable_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function shortlistable()
    {
        return $this->morphTo();
    }

    /**
     * Insert shortlist
     * @param  int $shortlistable_id
     * @return array
     */
    public function insertShortlist($shortlistable_id)
    {
        $this->user_id            = Auth::id();
        $this->shortlistable_type = 'Flat';
        $this->shortlistable_id   = $shortlistable_id;
        $data['data']             = $this->save();
        $result['success']        = true;

        return $result;
    }

    /**
     * Remove shortlist
     * @param  int $shortlistable_id
     * @return array
     */
    public function removeShortlist($shortlistable_id)
    {
        $data['data']      = $this->where('shortlistable_id', $shortlistable_id)->delete();
        $result['success'] = true;

        return $result;
    }

    public function getMyShortlists()
    {
        $result     = [];
        $shortlists = $this->where('user_id', Auth::id())->get();
        for ($i = 0; $i < count($shortlists); $i++) {

            if ($shortlists[$i]->shortlistable_type == 'Flat') {
                $result[$i] = Flat::where('id', $shortlists[$i]->shortlistable_id)->with(['shortlists' => function ($query) {
                    $query->where('user_id', Auth::id());
                }, 'reports' => function ($query) {
                    $query->where('user_id', Auth::id());
                }])->get()->first();
            } else {

            }
        }
        return $result;
    }
}

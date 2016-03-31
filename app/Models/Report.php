<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Report extends Model
{


	protected $table 	=	"reports";
	protected $fillable = 	['user_id','reportable_type','reportable_id'];

    public function user()
    {
		return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}

 	public function reportable()
    {
        return $this->morphTo();
    }

    public function getMyReports()
    {
        $shortlists = $this->where('user_id',Auth::id())->with('reportable')->get();

        return $shortlists;
    }

    /**
     * Insert shortlist
     * @param  int $shortlistable_id
     * @return array
     */
    public function insertReport($reportable_id)
    {
        $this->user_id               = Auth::id();
        $this->reportable_type       = 'Flat';
        $this->reportable_id         = $reportable_id;
        $data['data']                = $this->save();
        $result['success']           = true;

        return $result;
    }

    /**
     * Remove shortlist
     * @param  int $reportable_id
     * @return array
     */
    public function removeReport($reportable_id)
    {
        $data['data']       = $this->where('reportable_id',$reportable_id)->delete();
        $result['success']  = true;

        return $result;
    }

}

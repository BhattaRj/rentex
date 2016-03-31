<?php

namespace App\Models;

use Auth;
use DB;

class Flat extends BaseModel
{

    protected $table      = "flats";
    protected $morphClass = 'Flat';
    // protected $with         = ['createdBy'];
    protected $fillable = array('flat_no', 'no_rooms', 'no_bedrooms', 'no_kitchen', 'no_hall', 'floor_type', 'build_on',
        'earth_quake_protection', 'no_of_flats', 'description', 'price', 'price_negotiable',
        'district', 'vdc', 'ward_no', 'locality', 'nearest_road_width', 'nearest_road_condition',
        'main_rood_type', 'main_rood_name', 'main_road_distance', 'landmark', 'created_by', 'title');

    public function facilities()
    {
        return $this->belongsToMany('App\Models\Facility', 'flat_facilities', 'flat_id', 'facility_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    /**
     * Get all of the staff member's photos.
     */
    public function shortlists()
    {
        return $this->morphMany('App\Models\Shortlist', 'shortlistable');
    }

    /**
     * Get all of the staff member's photos.
     */
    public function reports()
    {
        return $this->morphMany('App\Models\Report', 'reportable');
    }

    /**
     * Get all flats with author and shortlists
     * @return collection
     */
    public function getFlats()
    {
        $query = $this->with(['shortlists' => function ($query) {
            $query->where('user_id', Auth::id());
        }, 'reports' => function ($query) {
            $query->where('user_id', Auth::id());
        }]);
        return $query;
    }

    /**
     * Get flat created by currrent user.
     * @return collection
     */
    public function getMyFlats()
    {
        $query = $this->with(['shortlists' => function ($query) {
            $query->where('user_id', Auth::id());
        }, 'reports' => function ($query) {
            $query->where('user_id', Auth::id());
        }]);
        return $query;
    }

    /**
     * Update the flat.
     * @param  object $request
     * @param  int $id
     * @return object
     */
    public function updateFlat($request, $id)
    {
        $flat_data = $request->input('data');

        for ($i = 0; $i < count($flat_data['facilities']); $i++) {
            $facilities[$i] = $flat_data['facilities'][$i]['id'];
        }

        $flat_data['created_by'] = Auth::id();

        $flat = $this->findById($id);

        $flat->update($flat_data, $id);

        $flat->facilities()->sync($facilities);
        return $flat;
    }

    public function scopeMyPost($query)
    {
        return $query->where('created_by', Auth::id());
    }

    /**
     * Returs top district with count
     * @param  integer $count no of items to returns.
     * @return array
     */
    public function getTopDistrictWithCount($count = 5)
    {
        return DB::table('flats')->select(DB::raw('count(*)as count'), 'district')->groupBy('district')->skip(0)->take($count)->get();
    }

    /**
     * Returns top citys with count.
     * @param  integer $count no. of items to returns.
     * @return array
     */
    public function getTopCityWithCount($count = 5)
    {
        return DB::table('flats')->select(DB::raw('count(*)as count'), 'vdc')->groupBy('vdc')->skip(0)->take($count)->get();
    }
}

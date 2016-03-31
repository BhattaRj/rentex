<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlatRequest;
use App\Models\Flat;
use Auth;
use Illuminate\Http\Request;

class FlatController extends Controller
{

    protected $flat;

    public function __construct(Flat $flat)
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'getLocality', 'getFilterData', 'getVdc']]);
        $this->flat = $flat;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $per_page     = 15;
        $current_page = 1;
        $query        = $this->flat->getFlats();

        if ($request->input('current_page')) {
            $current_page = $request->input('current_page');
        }

        if ($request->input('myFlats')) {

            $query->where('created_by', Auth::id());
        }

        if ($request->input('no_bedrooms')) {
            $query->where('no_bedrooms', $request->input('no_bedrooms'));
        }

        if ($request->input('no_kitchen')) {
            $query->where('no_kitchen', $request->input('no_kitchen'));
        }

        if ($request->input('min_price')) {
            $query->where('price', '>=', floatval($request->input('min_price')));
        }

        if ($request->input('max_price')) {
            $query->where('price', '<=', floatval($request->input('max_price')));
        }

        if ($request->input('district')) {
            $district = json_decode($request->input('district'));
            $query->where('district', floatval($district->id));
        }

        if ($request->input('district_id')) {
            $query->where('district', $request->input('district_id'));
        }

        if ($request->input('locality')) {
            $query->where('locality', $request->input('locality'));
        }

        if ($request->input('vdc')) {
            $query->where('vdc', $request->input('vdc'));
        }

        $skip            = ($current_page - 1) * $per_page;
        $result['total'] = $query->get()->count();
        $result['data']  = $query->skip($skip)->take($per_page)->get();

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(FlatRequest $request)
    {
        $flat               = $request->input('data');
        $flat['created_by'] = Auth::id();

        for ($i = 0; $i < count($flat['facilities']); $i++) {
            $facilities[$i] = $flat['facilities'][$i]['id'];
        }

        $flat = $this->flat->make($flat);

        $flat->facilities()->attach($facilities);

        $result['data']    = $flat;
        $result['success'] = true;
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $result['data']    = $this->flat->findById($id)->load('facilities', 'createdBy');
        $result['success'] = true;
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(FlatRequest $request, $id)
    {
        /**
         * Validate and update the flat recored.
         * Sync with facilites_flat povit table.
         */
        $result['data']    = $this->flat->updateFlat($request, $id);
        $result['success'] = true;

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(FlatRequest $request, $id)
    {
        $this->flat->remove($id) ? $result['success'] = true : $result['success'] = false;

        return $result;
    }

    /**
     * Return locality for type ahead
     * @param  Request $request
     * @return array
     */
    public function getLocality(Request $request)
    {
        $key = $request->input('locality');
        return $this->flat->select('locality')->where('locality', 'like', '%' . $key . '%')->groupBy('locality')->get();
    }

    /**
     * Return locality for type ahead
     * @param  Request $request
     * @return array
     */
    public function getVdc(Request $request)
    {
        $key = $request->input('vdc');
        return $this->flat->select('vdc')->where('vdc', 'like', '%' . $key . '%')->groupBy('vdc')->get();
    }

    /**
     * Returns data for filter the flats
     * @return array returns top disctrict and city.
     */
    public function getFilterData()
    {
        $result['districtsWithCount'] = $this->flat->getTopDistrictWithCount();
        $result['cityWithCount']      = $this->flat->getTopCityWithCount();

        return $result;
    }
}

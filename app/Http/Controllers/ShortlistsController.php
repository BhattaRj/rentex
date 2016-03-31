<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shortlist;
use Auth;

class ShortlistsController extends Controller
{
    protected $shortlist;

    public function __construct(Shortlist $shortlist)
    {
        $this->middleware('auth');
        $this->shortlist    = $shortlist;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $result['data']     = $this->shortlist->getMyShortlists();
        $result['success']  = true;
        return $result;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $shortlistable_id = $request->input('data')['shortlistable_id'];
        $shortlists       = $this->shortlist->where('user_id',Auth::id())->where('shortlistable_id',$shortlistable_id)->get();
        if($shortlists->count() >= 1){
            return $this->shortlist->removeShortlist($shortlistable_id);
        }
        else
        {
            return $this->shortlist->insertShortlist($shortlistable_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

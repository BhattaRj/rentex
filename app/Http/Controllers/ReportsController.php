<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Auth;

class ReportsController extends Controller
{
    protected $report;
    public function __construct(Report $report)
    {
        $this->middleware('auth');
        $this->report = $report;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $result['data']     = $this->report->getMyReports();
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
        $reportable_id = $request->input('data')['reportable_id'];

        $reports       = $this->report->where('user_id',Auth::id())->where('reportable_id',$reportable_id)->get();

        if($reports->count() >= 1){

            return $this->report->removeReport($reportable_id);
        }
        else
        {
            return $this->report->insertReport($reportable_id);
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

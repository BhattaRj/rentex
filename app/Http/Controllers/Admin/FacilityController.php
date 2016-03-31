<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Auth;
use Illuminate\Http\Request;

class FacilityController extends Controller
{

    protected $facility;

    /**
     * Inject Facility Model
     * Enable auth and admin controller.
     *
     * @param Facility $facility [description]
     */
    public function __construct(Facility $facility)
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['index']]);

        $this->facility = $facility;
    }

    /**
     * Returns all rows.
     * @return object
     */
    public function index()
    {
        return $this->facility->findall();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validation_rules());
        $result['data']    = $this->facility->make($request->input('data'));
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
        $result['data']    = $this->facility->findById($id);
        $result['success'] = true;
        return $result;
    }

    /**
     * Update the facility
     * @param  Request $request
     * @param  int  $id
     * @return object
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->validation_rules());

        $result['data']    = $this->facility->updateModel($request->input('data'), $id);
        $result['success'] = true;

        return $result;
    }

    /**
     * Remove the facility
     * @param  int $id
     * @return object
     */
    public function destroy($id)
    {
        $this->facility->remove($id) ? $result['success'] = true : $result['success'] = false;

        return $result;
    }

    /**
     * Returns validations rules.
     */
    private function validation_rules()
    {
        return [
            'data.title'       => 'required',
            'data.description' => 'required',
        ];
    }
}

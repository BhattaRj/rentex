<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Flat;
use Auth;
class FlatRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Flat $flat)
    {
        /**
         *  If flat id is presents in route
         *  checks if the author of the flat.
         *  if author then allow for delete and update.
         */

        if($this->route('flat'))
        {
            return $flat->where('id',$this->route('flat'))->where('created_by',Auth::id())->exists();
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        /**
         * Returns different rules based on the request type.
         */

        switch($this->method())
        {
            case 'GET':

            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                  'data.flat_no'        => 'required',
                  'data.facilities'     =>'required'
                ];
            }
            case 'PUT':{

                return [
                  'data.flat_no'        => 'required',
                  'data.facilities'     =>'required'
                ];
            }

            default:break;
        }
    }
}

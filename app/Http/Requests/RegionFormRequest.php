<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegionFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'lat' => 'required',
            'lon' => 'required'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Không được để trống tên',
            'lat.required' => 'Không được để trống tọa độ',
            'lon.required' => 'Không được để trông tọa độ'
        ];
    }
}

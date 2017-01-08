<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequirementFormRequest extends Request
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
            'name' => 'required|unique:requirements,id',
            'info' => 'required',
            'town_id' => 'numeric'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Mời nhập tên của dự án yêu cầu cứu trợ',
            'name.unique' => 'Tên dự án yêu cầu cứu trợ đã tồn tại, mời nhập tên khác',
            'info.required' => 'Mời nhập thông tin thiệt hại',
            'town_id.numeric' => 'Mời chọn một địa phương trong danh sách'
        ];
    }
}

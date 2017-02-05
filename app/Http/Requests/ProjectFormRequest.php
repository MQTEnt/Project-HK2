<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectFormRequest extends Request
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
            'name' => 'required|min:5',
            'from_date' => 'required',
            'to_date' => 'required|after:from_date',
            'items' => 'required',
            'plan' => 'required'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Không được để trống tên dự án cứu trợ',
            'name.min' => 'Tên dự án không được ngắn hơn 5 kí tự',
            'from_date.required' => 'Không được để trống ngày bắt đầu',
            'to_date.required' => 'Không được để trống này kết thúc',
            'to_date.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
            'items.required' => 'Không được để trống danh sách vật phẩm',
            'plan.required' =>'Không được để trống bản kế hoạch'
        ];
    }
}

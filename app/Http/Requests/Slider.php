<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Slider extends FormRequest
{
    private $table = 'slider';
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
        $id = $this->id;
        $condName = "bail|required|unique:$this->table,name";
        $condThumb = 'bail|required|image|max:500';

        if(!empty($id)){
            $condName = "bail|required|unique:$this->table,name,$id";
            $condThumb = 'bail|image|max:500';
        }
        return [
            'name' => $condName,
            'description' => 'bail|required',
            'status' => 'bail|required',
            'link' => 'bail|required|url', 
            'thumb' => $condThumb, 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.unique' => 'Tên đã tồn tại',
            'description.required'  => 'Mô không được bỏ trống',
            'status.required'  => 'Trạng thái không được bỏ trống',
            'link.required' => 'Link không được bỏ trống',
            'link.url' => 'Link không đúng định dạng',
            'thumb.required' => 'Anh không được bỏ trống',
            'thumb.image' => 'Anh không đúng định dạng',
            'thumb.max' => 'Anh có kích thước <= 500 kilobyte'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Category extends FormRequest
{
    private $table = 'category';
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

        if(!empty($id)){
            $condName = "bail|required|unique:$this->table,name,$id";
        }
        return [
            'name' => $condName,
            'status' => 'bail|required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.unique' => 'Tên đã tồn tại',
            'status.required'  => 'Trạng thái không được bỏ trống'
        ];
    }
}

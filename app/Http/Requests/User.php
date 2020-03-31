<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User extends FormRequest
{
    private $table            = 'user';
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
        $id     = $this->id;
        $task   = $this->task;

        $condAvatar   = '';
        $condUserName = '';
        $condEmail    = '';
        $condPass     = '';
        $condLevel    = '';
        $condStatus   = '';
        $condFullname = '';

        if($task === 'add-user'){
            $condUserName   = "bail|required|between:5,100|unique:$this->table,username";
            $condEmail      = "bail|required|email|unique:$this->table,email";
            $condFullname   = 'bail|required|min: 5';
            $condPass       = 'bail|required|between:5,100|confirmed';
            $condStatus     = 'bail|required';
            $condLevel      = 'bail|required';
            $condAvatar     = 'bail|required|image|max:500';
        }

        if($task === 'edit-user'){
            $condUserName   = "bail|required|between:5,100|unique:$this->table,username,$id"; 
            $condFullname   = 'bail|required|min: 5';
            $condAvatar     = 'bail|image|max:500';
            $condStatus     = 'bail|required';
            $condEmail      = "bail|required|email|unique:$this->table,email,$id";
        }

        if($task === 'change-pass'){
            $condPass = 'bail|required|between:5,100|confirmed';
        }

        return [
            'username' => $condUserName,
            'email'    => $condEmail,
            'fullname' => $condFullname,
            'status'   => $condStatus,
            'password' => $condPass,
            'level'    => $condLevel,
            'avatar'   => $condAvatar
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'UserName không được bỏ trống',
            'username.unique' => 'UserName đã tồn tại',
            'username.between' => 'UserName từ 5 tới 100 kí tự',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'fullname.required' => 'FullName không được bỏ trống',
            'fullname.min' => 'FullName có ít nhất 5 kí tự',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.between' => 'Password từ 5 tới 100 kí tự',
            'password.confirmed' => 'Password xác nhận không đúng',
            'level.required' => 'Level không được bỏ trống',
            'status.required' => 'Trạng thái không được bỏ trống',
            'avatar.required' => 'Avatar không được bỏ trống',
            'avatar.image' => 'Avatar không đúng định dạng',
            'avatar.max' => 'Avatar có kích thước <= 500 kilobyte'
        ];
    }
}

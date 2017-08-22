<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            //
            'name' => 'required|max:100',
            'email' => 'required|max:255|email',
            'password' => 'required|max:100|alpha_num',
            'role_id' => 'required',
            'file' => 'mimes:jpeg,png'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'نام باید وارد شود',
            'name.max' => 'نام حداکثر باید 100 کاراکتر باشد!',
            'email.required' => 'ایمیل باید وارد شود',
            'email.max' => 'ایمیل حداکثر باید 255 کاراکتر باشد!',
            'email.email' => 'ایمیل باید در قالب یک ایمیل معتبر باشد!',
            'password.required' => 'کلمه عبور باید وارد شود',
            'password.max' => 'کلمه عبور حداکثر باید 100 کاراکتر باشد!',
            'password.alpha_num' => 'کلمه عبور  باید ترکیب کاراکترهای حرفی و عددی باشد!',
            'role_id.required' => 'نقش کاربر باید انتخاب شود',
            'file.mimes' => ' باید فرمت تصویر png یا jpg انتخاب شود',

        ];
    }
}

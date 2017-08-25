<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostResquest extends FormRequest
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
            'title' => 'required|max:250',
            'body' => 'required',
            'category_id' => 'required',
            'file' => 'mimes:jpeg,png',
        ];
    }
    public function messages()
        {
            return [
                'title.required' => 'عنوان باید وارد شود',
                'title.max' => 'عنوان حداکثر باید 100 کاراکتر باشد!',
                'body.required' => 'متن باید وارد شود',

                'category_id.required' => 'گروه مربوط به مطلب باید وارد شود',

                'file.mimes' => ' باید فرمت تصویر png یا jpg انتخاب شود',

            ];
        }

}

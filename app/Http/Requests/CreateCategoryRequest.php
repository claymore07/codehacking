<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CreateCategoryRequest extends FormRequest
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
                    'name' => 'required|max:100|unique:categories',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                //\Session::flash('test', '1'.$this->input());

                return [


                    'name' => [
                        'required',

                        Rule::unique('categories')->ignore($this->category),
                    ],
                ];

        }
            default:break;
        }

    }
    public function messages()
        {
            return [
                'name.required' => 'نام باید وارد شود',
                'name.max' => 'نام حداکثر باید 100 کاراکتر باشد!',
                'name.unique'=>'نام دسته باید منحصر به فرد باشد!'
            ];
        }
}

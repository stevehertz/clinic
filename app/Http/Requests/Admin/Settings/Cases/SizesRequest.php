<?php

namespace App\Http\Requests\Admin\Settings\Cases;

use Illuminate\Foundation\Http\FormRequest;

class SizesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable']
        ];
    }
}

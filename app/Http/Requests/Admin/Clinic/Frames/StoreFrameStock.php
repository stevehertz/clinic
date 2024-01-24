<?php

namespace App\Http\Requests\Admin\Clinic\Frames;

use Illuminate\Foundation\Http\FormRequest;

class StoreFrameStock extends FormRequest
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
            'frame_id' => 'required|integer|exists:frames,id',
            'gender' => 'required|string|max:255',
            'color_id' => 'required|integer|exists:frame_colors,id',
            'shape_id' => 'required|integer|exists:frame_shapes,id',
            'opening' => 'required|numeric',
        ];
    }
}

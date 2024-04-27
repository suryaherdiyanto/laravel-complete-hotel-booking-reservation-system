<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'roomtype' => 'required|string',
            'total_adult' => 'required|integer|min:1',
            'total_child' => 'required|integer|min:1',
            'price' => 'required|integer',
            'size' => 'required',
            'discount' => 'required|integer|min:0',
            'room_capacity' => 'required|integer',
            'view' => 'required|string',
            'bed_style' => 'required|string',
        ];
    }
}

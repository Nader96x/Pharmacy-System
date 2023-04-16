<?php

namespace App\Http\Requests\Medicine;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:medicines,id',
            'name' => 'required|alpha|max:255|min:3',
            'price' => 'required|integer|min:1',
            'cost' => 'required|integer|min:1'
        ];
    }
}

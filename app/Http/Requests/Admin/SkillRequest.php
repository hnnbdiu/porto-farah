<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'percentage' => 'nullable|integer|min:0|max:100',
            'category' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama keahlian wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'icon.max' => 'Ikon maksimal 255 karakter.',
            'percentage.integer' => 'Persentase harus berupa angka.',
            'percentage.min' => 'Persentase minimal 0.',
            'percentage.max' => 'Persentase maksimal 100.',
            'sort_order.integer' => 'Urutan harus berupa angka.',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AchievementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:160',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'date' => 'nullable|date',
            'tags' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul pencapaian wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'date.date' => 'Format tanggal tidak valid.',
        ];
    }
}

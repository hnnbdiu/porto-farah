<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'nullable|string',
            'github_url' => 'nullable|url|max:255',
            'demo_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul proyek wajib diisi.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'description.required' => 'Deskripsi proyek wajib diisi.',
            'tech_stack.string' => 'Teknologi harus berupa teks.',
            'github_url.url' => 'Link GitHub harus berupa URL yang valid.',
            'demo_url.url' => 'Link Demo harus berupa URL yang valid.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}

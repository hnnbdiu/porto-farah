<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArtworkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->email === config('app.admin_email');
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'images' => 'required|array|max:20',
                'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
                'titles' => 'nullable|array',
                'titles.*' => 'nullable|string|max:120',
                'descriptions' => 'nullable|array',
                'descriptions.*' => 'nullable|string|max:500',
                'category' => 'nullable|string|max:255',
            ];
        }

        return [
            'title' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => 'Silakan pilih gambar terlebih dahulu.',
            'images.max' => 'Maksimal 20 gambar dalam sekali unggah.',
            'images.*.image' => 'File harus berupa gambar.',
            'images.*.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'images.*.max' => 'Ukuran gambar maksimal 10MB.',
            'titles.*.max' => 'Judul maksimal 120 karakter.',
            'descriptions.*.max' => 'Deskripsi maksimal 500 karakter.',
            'title.max' => 'Judul maksimal 120 karakter.',
            'description.max' => 'Deskripsi maksimal 500 karakter.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 10MB.',
        ];
    }
}

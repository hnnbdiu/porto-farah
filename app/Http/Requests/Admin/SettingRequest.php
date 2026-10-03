<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cv' => 'nullable|file|mimes:pdf|max:5120',
            'sosial_media.email' => 'nullable|email|max:255',
            'sosial_media.instagram' => 'nullable|string|max:255',
            'sosial_media.whatsapp' => 'nullable|regex:/^62[0-9]{7,13}$/',
        ];
    }

    protected function prepareForValidation()
    {
        $sosialMedia = $this->input('sosial_media', []);

        if (isset($sosialMedia['instagram'])) {
            $sosialMedia['instagram'] = str_replace(['@', ' '], '', $sosialMedia['instagram']);
        }

        if (isset($sosialMedia['whatsapp'])) {
            $wa = $sosialMedia['whatsapp'];
            $wa = preg_replace('/[^\d+]/', '', $wa);
            if (str_starts_with($wa, '0')) {
                $wa = '62' . substr($wa, 1);
            } elseif (str_starts_with($wa, '+62')) {
                $wa = '62' . substr($wa, 3);
            }
            $sosialMedia['whatsapp'] = $wa;
        }

        $this->merge([
            'sosial_media' => $sosialMedia
        ]);
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'foto.image' => 'Foto profil harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 5MB.',
            'cv.file' => 'CV harus berupa file.',
            'cv.mimes' => 'CV harus berformat PDF.',
            'cv.max' => 'Ukuran CV maksimal 5MB.',
            'sosial_media.email.email' => 'Format email tidak valid.',
            'sosial_media.whatsapp.regex' => 'Nomor WhatsApp tidak valid (harus 9-15 digit, diawali 0, 62, atau +62).',
        ];
    }
}

@extends('layouts.admin')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Pengaturan Profil</h1>
    <p class="text-gray-500 mt-1">Perbarui informasi profil yang tampil di website Anda.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-4xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $setting->nama ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('nama') border-red-500 @enderror" required>
                @error('nama') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Peran / Subjudul (Role)</label>
                <input type="text" name="role" value="{{ old('role', $setting->role ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('role') border-red-500 @enderror">
                @error('role') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Teks "Tentang Saya" (Bio)</label>
                <textarea name="bio" rows="8" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('bio') border-red-500 @enderror">{{ old('bio', $setting->bio ?? '') }}</textarea>
                <p class="text-xs text-gray-500">Gunakan baris baru (Enter) untuk memisahkan paragraf.</p>
                @error('bio') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Foto Profil (Maks 5MB, JPG/PNG/WEBP)</label>
                @if($setting->foto)
                    <div class="mb-2">
                        @if(Str::startsWith($setting->foto, 'http'))
                            <img src="{{ $setting->foto }}" class="w-24 h-24 object-cover rounded-full border-4 border-gray-100">
                        @else
                            <img src="{{ Storage::url($setting->foto) }}" class="w-24 h-24 object-cover rounded-full border-4 border-gray-100">
                        @endif
                    </div>
                @endif
                <input type="file" name="foto" accept="image/jpeg,image/png,image/webp" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('foto') border-red-500 @enderror">
                @error('foto') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">File CV / Resume (Maks 5MB, PDF)</label>
                @if($setting->cv_path)
                    <div class="mb-2 flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-800">{{ basename($setting->cv_path) }}</span>
<a href="{{ route('cv.show') }}" target="_blank" class="text-primary-500 hover:underline flex items-center gap-1 text-sm">                            <span class="material-symbols-outlined text-sm">picture_as_pdf</span> Lihat
                        </a>
                    </div>
                @endif
                <input type="file" name="cv" accept="application/pdf" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('cv') border-red-500 @enderror">
                @error('cv') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2 pt-4 pb-2 border-t border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Sosial Media</h3>
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Email Publik</label>
                <input type="email" name="sosial_media[email]" value="{{ old('sosial_media.email', $setting->sosial_media['email'] ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('sosial_media.email') border-red-500 @enderror">
                @error('sosial_media.email') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Username Instagram</label>
                <input type="text" name="sosial_media[instagram]" value="{{ old('sosial_media.instagram', $setting->sosial_media['instagram'] ?? '') }}" placeholder="Tanpa @" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('sosial_media.instagram') border-red-500 @enderror">
                <p class="text-xs text-gray-500">Contoh: farahraihanun</p>
                @error('sosial_media.instagram') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                <input type="text" name="sosial_media[whatsapp]" value="{{ old('sosial_media.whatsapp', $setting->sosial_media['whatsapp'] ?? '') }}" placeholder="Contoh: 081234567890" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('sosial_media.whatsapp') border-red-500 @enderror">
                <p class="text-xs text-gray-500">Otomatis diformat ke 62...</p>
                @error('sosial_media.whatsapp') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-xl font-medium transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection

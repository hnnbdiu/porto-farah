@extends('layouts.admin')

@section('title', isset($achievement) ? 'Edit Pencapaian' : 'Tambah Pencapaian')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">{{ isset($achievement) ? 'Edit Pencapaian' : 'Tambah Pencapaian' }}</h1>
    <a href="{{ route('admin.achievements.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-1 font-medium">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <form action="{{ isset($achievement) ? route('admin.achievements.update', $achievement) : route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($achievement))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Judul Pencapaian</label>
                <input type="text" name="title" value="{{ old('title', $achievement->title ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('title') border-red-500 @enderror" required>
                @error('title') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Tipe Pencapaian</label>
                <input type="text" name="type" value="{{ old('type', $achievement->type ?? '') }}" placeholder="Contoh: Kompetisi, Sertifikasi" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('type') border-red-500 @enderror">
                @error('type') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Ringkasan (Opsional, Maks 160 karakter)</label>
                <input type="text" name="summary" value="{{ old('summary', $achievement->summary ?? '') }}" placeholder="Kosongkan untuk memotong otomatis dari deskripsi" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('summary') border-red-500 @enderror">
                @error('summary') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="5" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('description') border-red-500 @enderror" required>{{ old('description', $achievement->description ?? '') }}</textarea>
                @error('description') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Tags (pisahkan dengan koma)</label>
                <input type="text" name="tags" value="{{ old('tags', isset($achievement) ? implode(', ', $achievement->tags ?? []) : '') }}" placeholder="Contoh: Juara 1, Web Dev" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('tags') border-red-500 @enderror">
                @error('tags') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="date" value="{{ old('date', $achievement->date ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('date') border-red-500 @enderror">
                @error('date') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Gambar/Sertifikat (Maks 2MB, JPG/PNG/WEBP)</label>
                @if(isset($achievement) && $achievement->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($achievement->image) }}" class="h-32 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('image') border-red-500 @enderror">
                @error('image') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-xl font-medium transition-colors">
                Simpan Pencapaian
            </button>
        </div>
    </form>
</div>
@endsection

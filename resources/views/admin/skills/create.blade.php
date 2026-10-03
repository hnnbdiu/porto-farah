@extends('layouts.admin')

@section('title', isset($skill) ? 'Edit Keahlian' : 'Tambah Keahlian')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">{{ isset($skill) ? 'Edit Keahlian' : 'Tambah Keahlian' }}</h1>
    <a href="{{ route('admin.skills.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-1 font-medium">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <form action="{{ isset($skill) ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" method="POST">
        @csrf
        @if(isset($skill))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Nama Keahlian</label>
                <input type="text" name="name" value="{{ old('name', $skill->name ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('name') border-red-500 @enderror" required>
                @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Kategori (opsional)</label>
                <input type="text" name="category" value="{{ old('category', $skill->category ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('category') border-red-500 @enderror">
                @error('category') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Ikon (Material Symbols, opsional)</label>
                <input type="text" name="icon" value="{{ old('icon', $skill->icon ?? '') }}" placeholder="Contoh: code, storage, web" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('icon') border-red-500 @enderror">
                @error('icon') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                <p class="text-xs text-gray-500 mt-1">Cari ikon di <a href="https://fonts.google.com/icons" target="_blank" class="text-primary-500">Google Fonts</a></p>
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Persentase (0-100)</label>
                <input type="number" min="0" max="100" name="percentage" value="{{ old('percentage', $skill->percentage ?? 0) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('percentage') border-red-500 @enderror">
                @error('percentage') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Urutan (Angka)</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order ?? 0) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('sort_order') border-red-500 @enderror">
                @error('sort_order') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-xl font-medium transition-colors">
                Simpan Keahlian
            </button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('title', isset($project) ? 'Edit Proyek' : 'Tambah Proyek')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">{{ isset($project) ? 'Edit Proyek' : 'Tambah Proyek' }}</h1>
    <a href="{{ route('admin.projects.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-1 font-medium">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <form action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($project))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Judul Proyek</label>
                <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('title') border-red-500 @enderror" required>
                @error('title') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="5" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('description') border-red-500 @enderror" required>{{ old('description', $project->description ?? '') }}</textarea>
                @error('description') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Teknologi (pisahkan dengan koma)</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', isset($project) ? implode(', ', $project->tech_stack ?? []) : '') }}" placeholder="Contoh: Laravel, TailwindCSS, MySQL" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('tech_stack') border-red-500 @enderror">
                @error('tech_stack') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Link GitHub</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('github_url') border-red-500 @enderror">
                @error('github_url') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Link Demo</label>
                <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url ?? '') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('demo_url') border-red-500 @enderror">
                @error('demo_url') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Gambar Proyek (Maks 2MB, JPG/PNG/WEBP)</label>
                @if(isset($project) && $project->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($project->image) }}" class="h-32 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all @error('image') border-red-500 @enderror">
                @error('image') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1 md:col-span-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $project->is_published ?? true) ? 'checked' : '' }} class="w-5 h-5 text-primary-600 rounded border-gray-300 focus:ring-primary-500">
                    <span class="text-sm font-medium text-gray-700">Tampilkan Proyek (Status Tayang)</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-xl font-medium transition-colors">
                Simpan Proyek
            </button>
        </div>
    </form>
</div>
@endsection

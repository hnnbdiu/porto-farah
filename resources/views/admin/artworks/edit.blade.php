@extends('layouts.admin')

@section('title', 'Edit Gambar Galeri')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Edit Info Gambar</h1>
    <a href="{{ route('admin.artworks.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-1 font-medium">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <form action="{{ route('admin.artworks.update', $artwork) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex flex-col md:flex-row gap-6 mb-6">
            <div class="w-full md:w-1/3 space-y-4">
                <div class="rounded-xl overflow-hidden border border-gray-200 relative aspect-square group bg-gray-100">
                    <img id="preview-img" src="{{ $artwork->thumbnail_url }}" alt="Preview" class="w-full h-full object-cover">
                </div>
                
                <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-700">Ganti Gambar (Opsional)</label>
                    <input type="file" name="image" id="image-input" accept="image/jpeg,image/png,image/webp" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-colors">
                    <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti gambar. Maks 10MB.</p>
                    @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <div class="w-full md:w-2/3 space-y-5">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $artwork->title) }}" placeholder="Judul Karya..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all">
                    @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-700">Kategori (Opsional)</label>
                    <input type="text" name="category" value="{{ old('category', $artwork->category) }}" placeholder="mis. Ilustrasi, Digital Art..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all">
                    @error('category') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                    <textarea name="description" rows="4" placeholder="Ceritakan sedikit tentang karya ini..." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all">{{ old('description', $artwork->description) }}</textarea>
                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $artwork->is_published) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 rounded border-gray-300 focus:ring-primary-500">
                    <label for="is_published" class="text-sm font-medium text-gray-700">Tampilkan di Galeri Publik</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.artworks.index') }}" class="px-6 py-2 rounded-xl text-gray-600 hover:bg-gray-100 font-medium transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-xl font-medium transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('image-input').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            if (file.size > 10 * 1024 * 1024) {
                alert(`File terlalu besar. Maksimal 10MB.`);
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

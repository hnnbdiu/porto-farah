@extends('layouts.admin')

@section('title', 'Unggah Karya')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Unggah Gambar ke Galeri</h1>
    <a href="{{ route('admin.artworks.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-1 font-medium">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <form action="{{ route('admin.artworks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="space-y-6 mb-6">
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Pilih Gambar (Maks 20 gambar, 10MB per gambar)</label>
                <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl relative hover:bg-gray-50 transition-colors">
                    <div class="space-y-1 text-center">
                        <span class="material-symbols-outlined text-4xl text-gray-400">cloud_upload</span>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-500 hover:text-primary-400 focus-within:outline-none">
                                <span>Pilih file gambar</span>
                                <input id="file-upload" name="images[]" type="file" multiple class="sr-only" accept="image/jpeg,image/png,image/webp">
                            </label>
                            <p class="pl-1">atau tarik dan lepas ke sini</p>
                        </div>
                        <p class="text-xs text-gray-500">JPG, PNG, WEBP max 10MB</p>
                    </div>
                </div>
                @error('images') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                @error('images.*') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                @error('titles.*') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                @error('descriptions.*') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="space-y-1 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Kategori Publik (Opsional)</label>
                <input type="text" name="category" placeholder="mis. Ilustrasi, Digital Art, dll." class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all">
                @error('category') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div id="preview-container" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 hidden">
                <!-- Preview images will be shown here -->
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button type="submit" id="submit-btn" class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-xl font-medium transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">upload</span>
                Mulai Mengunggah
            </button>
        </div>
    </form>
</div>

<script>
    const fileUpload = document.getElementById('file-upload');
    const previewContainer = document.getElementById('preview-container');
    const submitBtn = document.getElementById('submit-btn');

    fileUpload.addEventListener('change', function(e) {
        previewContainer.innerHTML = '';
        const files = Array.from(e.target.files);
        
        if (files.length > 0) {
            previewContainer.classList.remove('hidden');
        } else {
            previewContainer.classList.add('hidden');
        }
        
        if (files.length > 20) {
            alert('Maksimal 20 gambar yang dapat dipilih!');
            fileUpload.value = '';
            previewContainer.classList.add('hidden');
            return;
        }

        files.forEach((file, index) => {
            if (file.size > 10 * 1024 * 1024) {
                alert(`File ${file.name} terlalu besar. Maksimal 10MB.`);
                return;
            }
            
            // Create container first to preserve order
            const item = document.createElement('div');
            item.className = 'flex gap-4 p-4 border border-gray-200 rounded-xl items-start bg-gray-50';
            item.dataset.index = index;
            previewContainer.appendChild(item);

            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrap = document.createElement('div');
                imgWrap.className = 'w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden bg-gray-200 border border-gray-300';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                
                imgWrap.appendChild(img);
                
                const inputsWrap = document.createElement('div');
                inputsWrap.className = 'flex-1 space-y-2';
                
                const titleInput = document.createElement('input');
                titleInput.type = 'text';
                titleInput.name = 'titles[]';
                titleInput.placeholder = 'Judul (Opsional, max 120 kar)';
                titleInput.className = 'w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary-500 outline-none';
                titleInput.maxLength = 120;
                
                const descInput = document.createElement('textarea');
                descInput.name = 'descriptions[]';
                descInput.placeholder = 'Deskripsi singkat (Opsional, max 500 kar)';
                descInput.rows = 2;
                descInput.className = 'w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary-500 outline-none resize-none';
                descInput.maxLength = 500;
                
                inputsWrap.appendChild(titleInput);
                inputsWrap.appendChild(descInput);
                
                item.appendChild(imgWrap);
                item.appendChild(inputsWrap);
            }
            reader.readAsDataURL(file);
        });
    });

    document.querySelector('form').addEventListener('submit', function() {
        submitBtn.innerHTML = '<span class="material-symbols-outlined text-sm animate-spin">refresh</span> Sedang Mengunggah...';
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
    });
</script>
@endsection

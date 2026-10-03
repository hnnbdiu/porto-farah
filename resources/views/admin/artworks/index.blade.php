@extends('layouts.admin')

@section('title', 'Galeri Karya')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Galeri Karya</h1>
    <a href="{{ route('admin.artworks.create') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-xl font-medium transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined">add_photo_alternate</span>
        Unggah Gambar
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <p class="text-sm text-gray-500 mb-6">Kelola galeri karya Anda. Anda dapat mengubah urutan gambar, mengedit judul, atau menghapus gambar.</p>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4" id="artworks-grid">
        @forelse($artworks as $artwork)
        <div class="relative group bg-gray-50 rounded-xl overflow-hidden border border-gray-100 aspect-square" data-id="{{ $artwork->id }}">
            <img src="{{ $artwork->thumbnail_url }}" alt="{{ $artwork->title ?: 'Karya Farah Raihanun Badiu' }}" class="w-full h-full object-cover">
            
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col p-3">
                <div class="flex justify-between items-start gap-2">
                    @if($artwork->title)
                        <span class="bg-white/20 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-lg truncate max-w-[70%]" title="{{ $artwork->title }}">
                            {{ $artwork->title }}
                        </span>
                    @else
                        <a href="{{ route('admin.artworks.edit', $artwork) }}" class="bg-gray-500/80 backdrop-blur-sm text-gray-200 text-[10px] px-2 py-1 rounded-lg truncate max-w-[70%] hover:bg-gray-500 transition-colors">
                            Belum ada judul
                        </a>
                    @endif
                    
                    <div class="flex flex-col gap-1 items-end">
                        <a href="{{ route('admin.artworks.edit', $artwork) }}" class="text-white bg-black/40 rounded-full hover:text-primary-400 p-1 flex items-center justify-center w-6 h-6">
                            <span class="material-symbols-outlined text-[14px]">edit</span>
                        </a>
                        <form action="{{ route('admin.artworks.destroy', $artwork) }}" method="POST" onsubmit="return confirm('Hapus gambar ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-black/40 rounded-full hover:text-red-400 p-1 flex items-center justify-center w-6 h-6">
                                <span class="material-symbols-outlined text-[14px]">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @if(!$artwork->is_published)
                <div class="absolute bottom-2 left-2 bg-yellow-500/90 backdrop-blur-sm text-white text-[10px] px-2 py-0.5 rounded font-medium">Draft</div>
            @endif
        </div>
        @empty
        <div class="col-span-full py-12 text-center text-gray-400">
            <span class="material-symbols-outlined text-4xl mb-2">imagesmode</span>
            <p>Belum ada karya di galeri.</p>
        </div>
        @endforelse
    </div>
    
    <div class="mt-6">
        {{ $artworks->links() }}
    </div>
</div>
@endsection

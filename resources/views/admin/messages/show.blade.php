@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Detail Pesan</h1>
    <a href="{{ route('admin.messages.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-1 font-medium">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-3xl">
    <div class="flex justify-between items-start mb-6 pb-6 border-b border-gray-100">
        <div>
            <h2 class="text-lg font-bold text-gray-800">{{ $message->name }}</h2>
            <a href="mailto:{{ $message->email }}" class="text-primary-500 hover:underline">{{ $message->email }}</a>
        </div>
        <div class="text-sm text-gray-500">
            {{ $message->created_at->format('d M Y, H:i') }}
        </div>
    </div>
    
    <div class="prose max-w-none text-gray-700 whitespace-pre-wrap">
        {{ $message->body }}
    </div>

    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
        <a href="mailto:{{ $message->email }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-xl font-medium transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">reply</span> Balas
        </a>
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-xl font-medium transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">delete</span> Hapus
            </button>
        </form>
    </div>
</div>
@endsection

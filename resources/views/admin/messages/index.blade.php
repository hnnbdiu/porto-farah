@extends('layouts.admin')

@section('title', 'Kotak Masuk')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Pesan Masuk</h1>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-sm">
                    <th class="p-4 font-medium">Status</th>
                    <th class="p-4 font-medium">Pengirim</th>
                    <th class="p-4 font-medium">Pesan</th>
                    <th class="p-4 font-medium">Tanggal</th>
                    <th class="p-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($messages as $message)
                <tr class="hover:bg-gray-50/50 {{ !$message->is_read ? 'bg-primary-50/30' : '' }}">
                    <td class="p-4">
                        @if(!$message->is_read)
                            <span class="flex w-3 h-3 bg-primary-500 rounded-full"></span>
                        @else
                            <span class="flex w-3 h-3 bg-gray-300 rounded-full"></span>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="font-medium text-gray-800">{{ $message->name }}</div>
                        <div class="text-xs text-gray-500">{{ $message->email }}</div>
                    </td>
                    <td class="p-4 text-gray-600 text-sm max-w-xs truncate">
                        {{ Str::limit($message->body, 50) }}
                    </td>
                    <td class="p-4 text-gray-600 text-sm">
                        {{ $message->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.messages.show', $message) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                            </a>
                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">
                        Belum ada pesan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="p-4 border-t border-gray-100">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection

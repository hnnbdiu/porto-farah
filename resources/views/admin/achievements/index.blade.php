@extends('layouts.admin')

@section('title', 'Kelola Pencapaian')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Pencapaian</h1>
    <a href="{{ route('admin.achievements.create') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined">add</span>
        Tambah Pencapaian
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-sm">
                    <th class="p-4 font-medium">Gambar</th>
                    <th class="p-4 font-medium">Judul & Tipe</th>
                    <th class="p-4 font-medium">Tanggal</th>
                    <th class="p-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($achievements as $achievement)
                <tr class="hover:bg-gray-50/50">
                    <td class="p-4">
                        @if($achievement->image)
                        <img src="{{ Storage::url($achievement->image) }}" class="w-16 h-12 object-cover rounded-lg" alt="Thumbnail">
                        @else
                        <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                            <span class="material-symbols-outlined">emoji_events</span>
                        </div>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="font-medium text-gray-800">{{ $achievement->title }}</div>
                        <div class="text-xs text-gray-500">{{ $achievement->type ?? '-' }}</div>
                    </td>
                    <td class="p-4 text-gray-600">
                        {{ $achievement->date ? \Carbon\Carbon::parse($achievement->date)->format('d M Y') : '-' }}
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.achievements.edit', $achievement) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.achievements.destroy', $achievement) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pencapaian ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500">
                        Belum ada pencapaian.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($achievements->hasPages())
    <div class="p-4 border-t border-gray-100">
        {{ $achievements->links() }}
    </div>
    @endif
</div>
@endsection

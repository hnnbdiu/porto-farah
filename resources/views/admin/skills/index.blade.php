@extends('layouts.admin')

@section('title', 'Kelola Keahlian')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Keahlian</h1>
    <a href="{{ route('admin.skills.create') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined">add</span>
        Tambah Keahlian
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-sm">
                    <th class="p-4 font-medium">Ikon & Nama</th>
                    <th class="p-4 font-medium">Kategori</th>
                    <th class="p-4 font-medium">Persentase</th>
                    <th class="p-4 font-medium">Urutan</th>
                    <th class="p-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($skills as $skill)
                <tr class="hover:bg-gray-50/50">
                    <td class="p-4 font-medium text-gray-800 flex items-center gap-3">
                        @if($skill->icon)
                            <span class="material-symbols-outlined text-primary-500">{{ $skill->icon }}</span>
                        @endif
                        {{ $skill->name }}
                    </td>
                    <td class="p-4 text-gray-600">{{ $skill->category ?? '-' }}</td>
                    <td class="p-4 text-gray-600">{{ $skill->percentage }}%</td>
                    <td class="p-4 text-gray-600">{{ $skill->sort_order }}</td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.skills.edit', $skill) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keahlian ini?');">
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
                    <td colspan="5" class="p-8 text-center text-gray-500">
                        Belum ada keahlian.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($skills->hasPages())
    <div class="p-4 border-t border-gray-100">
        {{ $skills->links() }}
    </div>
    @endif
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Kelola Proyek')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Proyek</h1>
    <a href="{{ route('admin.projects.create') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined">add</span>
        Tambah Proyek
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-sm">
                    <th class="p-4 font-medium">Gambar</th>
                    <th class="p-4 font-medium">Judul</th>
                    <th class="p-4 font-medium">Teknologi</th>
                    <th class="p-4 font-medium">Status</th>
                    <th class="p-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($projects as $project)
                <tr class="hover:bg-gray-50/50">
                    <td class="p-4">
                        @if($project->image)
                        <img src="{{ Storage::url($project->image) }}" class="w-16 h-12 object-cover rounded-lg" alt="Thumbnail">
                        @else
                        <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                            <span class="material-symbols-outlined">image</span>
                        </div>
                        @endif
                    </td>
                    <td class="p-4 font-medium text-gray-800">{{ $project->title }}</td>
                    <td class="p-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($project->tech_stack ?? [] as $tech)
                            <span class="text-xs px-2 py-1 bg-primary-50 text-primary-600 rounded-md">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="p-4">
                        @if($project->is_published)
                        <span class="text-xs px-2 py-1 bg-green-50 text-green-600 rounded-md font-medium">Tayang</span>
                        @else
                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-500 rounded-md font-medium">Sembunyikan</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');">
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
                        Belum ada proyek.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($projects->hasPages())
    <div class="p-4 border-t border-gray-100">
        {{ $projects->links() }}
    </div>
    @endif
</div>
@endsection

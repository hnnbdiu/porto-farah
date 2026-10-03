@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
@php
    $projectsCount = \App\Models\Project::count();
    $skillsCount = \App\Models\Skill::count();
    $achievementsCount = \App\Models\Achievement::count();
    $messagesCount = \App\Models\Message::count();
    $unreadMessagesCount = \App\Models\Message::where('is_read', false)->count();
    $latestMessages = \App\Models\Message::latest()->take(5)->get();
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center text-primary-500">
            <span class="material-symbols-outlined">work</span>
        </div>
        <div>
            <div class="text-3xl font-bold text-gray-800">{{ $projectsCount }}</div>
            <div class="text-sm font-medium text-gray-500">Proyek</div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500">
            <span class="material-symbols-outlined">code</span>
        </div>
        <div>
            <div class="text-3xl font-bold text-gray-800">{{ $skillsCount }}</div>
            <div class="text-sm font-medium text-gray-500">Keahlian</div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-500">
            <span class="material-symbols-outlined">emoji_events</span>
        </div>
        <div>
            <div class="text-3xl font-bold text-gray-800">{{ $achievementsCount }}</div>
            <div class="text-sm font-medium text-gray-500">Pencapaian</div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 relative">
        <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
            <span class="material-symbols-outlined">mail</span>
        </div>
        <div>
            <div class="text-3xl font-bold text-gray-800">{{ $messagesCount }}</div>
            <div class="text-sm font-medium text-gray-500">Pesan Masuk</div>
        </div>
        @if($unreadMessagesCount > 0)
        <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center shadow-md">
            {{ $unreadMessagesCount }}
        </div>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Pesan Terbaru</h2>
            <a href="{{ route('admin.messages.index') }}" class="text-sm font-medium text-primary-500 hover:text-primary-600">Lihat Semua</a>
        </div>
        <div class="p-0">
            @forelse($latestMessages as $message)
                <a href="{{ route('admin.messages.show', $message) }}" class="block p-4 border-b border-gray-50 hover:bg-gray-50 transition-colors {{ !$message->is_read ? 'bg-primary-50/20' : '' }}">
                    <div class="flex justify-between items-start mb-1">
                        <span class="font-medium text-gray-800 text-sm">{{ $message->name }}</span>
                        <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-gray-600 truncate">{{ $message->body }}</p>
                </a>
            @empty
                <div class="p-8 text-center text-gray-500 text-sm">
                    Belum ada pesan terbaru.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

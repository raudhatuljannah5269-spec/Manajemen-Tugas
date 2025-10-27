@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-blue-50 rounded-2xl shadow-md">
    <h1 class="text-3xl font-bold text-blue-700 mb-4">🌸 Daftar Tugas Kamu</h1>

    <a href="{{ route('tasks.create') }}" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-full mb-3 inline-block">+ Tambah Tugas</a>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <div class="grid gap-3">
        @forelse($tasks as $task)
        <div class="p-4 bg-white rounded-xl shadow flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-lg text-blue-600">{{ $task->title }}</h2>
                <p class="text-gray-500">{{ $task->description }}</p>
                <p class="text-xs text-gray-400">Deadline: {{ $task->deadline ?? '-' }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700">✏️</a>
                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus tugas ini?')" class="text-pink-500 hover:text-red-600">🗑️</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-gray-500">Belum ada tugas nih 💤</p>
        @endforelse
    </div>
</div>
@endsection

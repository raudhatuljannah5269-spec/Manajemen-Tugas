@extends('layouts.app')

@section('content')
<div class="p-8 text-center bg-blue-100 min-h-screen">
    <h1 class="text-2xl font-bold text-blue-700 mb-8">📋 Daftar Tugas</h1>

    <!-- Tombol Tambah Tugas -->
    <div class="mt-8 mb-8">
        <a href="{{ route('tasks.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md font-semibold">
           ➕ Tambah Tugas
        </a>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <!-- Kolom kiri: Belum selesai -->
        <div class="bg-white rounded-xl shadow-md p-5">
            <h2 class="font-semibold text-lg text-blue-600 mb-3">Tugas Belum Selesai</h2>

            @if($tasksBelum->isEmpty())
                <p class="text-gray-500 italic">Tidak ada tugas belum selesai.</p>
            @else
                @foreach($tasksBelum as $task)
                    <div class="p-3 border-b flex justify-between items-center">
                        <div class="text-left">
                            <h3 class="font-medium text-gray-800">{{ $task->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $task->description }}</p>

                            {{-- Deadline --}}
                            @if($task->deadline)
                                @php
                                    $isOverdue = \Carbon\Carbon::parse($task->deadline)->isPast();
                                    $deadlineColor = $isOverdue ? 'text-red-500 font-semibold' : 'text-pink-500';
                                @endphp
                                <p class="text-sm {{ $deadlineColor }}">
                                    ⏰ Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                    @if($isOverdue)
                                        <span class="text-xs text-gray-400">(Sudah lewat)</span>
                                    @endif
                                </p>
                            @endif
                        </div>

                        <div class="flex gap-2">
                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                                @csrf
                                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm shadow">
                                    Selesai
                                </button>
                            </form>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus tugas ini?')" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm shadow">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Kolom kanan: Selesai -->
        <div class="bg-white rounded-xl shadow-md p-5">
            <h2 class="font-semibold text-lg text-green-600 mb-3">Tugas Selesai</h2>

            @if($tasksSelesai->isEmpty())
                <p class="text-gray-500 italic">Belum ada tugas yang selesai.</p>
            @else
                @foreach($tasksSelesai as $task)
                    <div class="p-3 border-b flex justify-between items-center">
                        <div class="text-left">
                            <h3 class="font-medium text-gray-800">{{ $task->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $task->description }}</p>

                            {{-- Deadline --}}
                            @if($task->deadline)
                                <p class="text-sm text-green-500">
                                    ✅ Selesai sebelum: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex gap-2">
                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                                @csrf
                                <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm shadow">
                                    Batalkan
                                </button>
                            </form>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus tugas ini?')" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm shadow">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="p-8 bg-blue-100 min-h-screen flex flex-col items-center">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">📝 Tambah Tugas Baru</h1>

    <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-lg">
        <form action="{{ route('tasks.store') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <input type="text" name="title" placeholder="Judul tugas" 
                   class="border rounded-lg p-2 w-full" required>

            <textarea name="description" placeholder="Deskripsi (opsional)" 
                      class="border rounded-lg p-2 w-full"></textarea>

            <!-- Tambah input deadline -->
            <label class="text-left text-gray-600 font-medium">Tenggat Waktu (opsional):</label>
            <input type="date" name="deadline" 
                   class="border rounded-lg p-2 w-full">

            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">← Kembali</a>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg">
                    Simpan Tugas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

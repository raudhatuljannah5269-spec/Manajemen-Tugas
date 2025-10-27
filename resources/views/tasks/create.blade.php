@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-blue-50 rounded-2xl shadow-md">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">📝 Tambah Tugas Baru</h1>

    <form method="POST" action="{{ route('tasks.store') }}" class="space-y-4">
        @csrf
        <input type="text" name="title" placeholder="Judul Tugas" class="w-full p-3 border rounded-xl focus:ring focus:ring-blue-200" required>
        <textarea name="description" placeholder="Deskripsi" class="w-full p-3 border rounded-xl focus:ring focus:ring-blue-200"></textarea>
        <input type="date" name="deadline" class="w-full p-3 border rounded-xl focus:ring focus:ring-blue-200">
        <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-full">Simpan</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="bg-blue-100 min-h-screen py-10">
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-blue-600 mb-6 text-center">📊 Laporan Tugas</h1>

        <table class="w-full border border-gray-300 rounded-lg">
            <thead class="bg-blue-200">
                <tr>
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Judul</th>
                    <th class="py-2 px-4 border">Deskripsi</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $index => $task)
                    <tr class="text-center border-t">
                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                        <td class="py-2 px-4">{{ $task->title }}</td>
                        <td class="py-2 px-4">{{ $task->description }}</td>
                        <td class="py-2 px-4">
                            @if($task->status)
                                <span class="text-green-600 font-semibold">Selesai</span>
                            @else
                                <span class="text-red-500 font-semibold">Belum</span>
                            @endif
                        </td>
                        <td class="py-2 px-4">{{ $task->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-gray-500 italic text-center">
                            Tidak ada data tugas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6 text-center">
            <a href="{{ route('report.download') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow">
               📥 Unduh Laporan PDF
            </a>
        </div>
    </div>
</div>
@endsection

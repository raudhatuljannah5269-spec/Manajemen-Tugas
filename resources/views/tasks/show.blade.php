<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            📄 Detail Tugas
        </h2>
    </x-slot>

    <div class="py-10 bg-blue-50 min-h-screen flex justify-center">
        <div class="bg-white shadow-lg p-6 rounded-xl w-full max-w-2xl">

            <h3 class="text-2xl font-bold text-gray-800 mb-4">
                {{ $task->title }}
            </h3>

            <p class="text-gray-700 mb-3">
                {{ $task->description ?? 'Tidak ada deskripsi.' }}
            </p>

            <p class="text-gray-600 mb-3">
                <strong>Status:</strong>
                @if($task->status)
                    <span class="text-green-600 font-semibold">Selesai</span>
                @else
                    <span class="text-red-500 font-semibold">Belum selesai</span>
                @endif
            </p>

            @if($task->deadline)
                <p class="text-gray-600 mb-4">
                    <strong>Deadline:</strong>
                    {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                </p>
            @endif

            <div class="flex justify-between mt-6">
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg text-sm">⬅ Kembali</a>

                <div class="flex gap-2">
                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                        @csrf
                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm">
                            Toggle Status
                        </button>
                    </form>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus tugas ini?')" 
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

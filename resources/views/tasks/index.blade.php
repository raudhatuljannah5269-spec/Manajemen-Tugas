<x-app-layout>
    <div class="py-10 bg-blue-50 min-h-screen flex justify-center">
        <div class="w-full max-w-5xl bg-transparent px-6">

            <h1 class="text-3xl font-bold text-blue-700 mb-8 text-center">📋 Dashboard Tugas</h1>

            {{-- Form tambah tugas --}}
            @auth
                <form action="{{ route('tasks.store') }}" method="POST"
                    class="flex flex-col sm:flex-row gap-3 mb-10 justify-center">
                    @csrf
                    <input type="text" name="title" placeholder="Tulis tugas baru..."
                        class="flex-1 rounded-xl border border-blue-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-xl shadow">
                        ➕ Tambah
                    </button>
                </form>
            @endauth

            {{-- Dua kolom tugas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Belum selesai --}}
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h2 class="text-lg font-semibold text-blue-600 mb-4 text-center">⏳ Belum Selesai</h2>

                    @if ($tasksBelum->isEmpty())
                        <p class="text-gray-500 italic text-center">Tidak ada tugas belum selesai 😴</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($tasksBelum as $task)
                                <li class="flex justify-between items-center bg-blue-100 p-3 rounded-xl shadow-sm">
                                    <span class="font-medium text-blue-800">{{ $task->title }}</span>
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                                            @csrf
                                            <button
                                                class="bg-green-400 hover:bg-green-500 text-white text-sm px-3 py-1 rounded-lg shadow">
                                                ✔️ Selesai
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="bg-red-400 hover:bg-red-500 text-white text-sm px-3 py-1 rounded-lg shadow">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Selesai --}}
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h2 class="text-lg font-semibold text-green-600 mb-4 text-center">🎉 Selesai</h2>

                    @if ($tasksSelesai->isEmpty())
                        <p class="text-gray-500 italic text-center">Belum ada tugas selesai ✨</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($tasksSelesai as $task)
                                <li class="flex justify-between items-center bg-green-100 p-3 rounded-xl shadow-sm">
                                    <span class="font-medium text-gray-700 line-through">{{ $task->title }}</span>
                                    <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                                        @csrf
                                        <button
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-3 py-1 rounded-lg shadow">
                                            ↩️ Kembalikan
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            📝 Tambah Tugas Baru
        </h2>
    </x-slot>

    <div class="py-12 bg-blue-50 min-h-screen flex justify-center">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg border border-gray-200">
            <form action="{{ route('tasks.store') }}" method="POST" class="flex flex-col gap-5">
                @csrf

                <!-- Judul -->
                <div class="text-left">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">
                        Judul Tugas
                    </label>
                    <input type="text" id="title" name="title"
                        class="border rounded-lg p-2 w-full focus:ring-blue-400 focus:border-blue-400"
                        placeholder="Masukkan judul tugas..." required>
                </div>

                <!-- Deskripsi -->
                <div class="text-left">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">
                        Deskripsi (opsional)
                    </label>
                    <textarea id="description" name="description"
                        class="border rounded-lg p-2 w-full focus:ring-blue-400 focus:border-blue-400"
                        placeholder="Tuliskan deskripsi tugas..."></textarea>
                </div>

                <!-- Deadline -->
                <div class="text-left">
                    <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-1">
                        Tenggat Waktu (opsional)
                    </label>
                    <input type="date" id="deadline" name="deadline"
                        class="border rounded-lg p-2 w-full focus:ring-blue-400 focus:border-blue-400">
                </div>

                <!-- Tombol -->
                <div class="flex justify-between items-center mt-4">
                    <a href="{{ route('dashboard') }}"
                       class="text-blue-500 hover:underline">← Kembali</a>

                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow">
                        Simpan Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

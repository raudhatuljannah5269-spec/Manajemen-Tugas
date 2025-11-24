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
                <div id="belumSelesai" class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h2 class="text-lg font-semibold text-blue-600 mb-4 text-center">⏳ Belum Selesai</h2>

                    @if ($tasksBelum->isEmpty())
                        <p class="text-gray-500 italic text-center">Tidak ada tugas belum selesai 😴</p>
                    @else
                        <ul id="listBelumSelesai" class="space-y-4">
                            @foreach ($tasksBelum as $task)
                                <li id="task-{{ $task->id }}" class="flex justify-between items-center bg-blue-100 p-3 rounded-xl shadow-sm">
                                    <span class="font-medium text-blue-800">{{ $task->title }}</span>
                                    <select class="task-status bg-white border border-gray-300 px-2 py-1 rounded-lg shadow-sm"
                                        data-id="{{ $task->id }}">
                                        <option value="0" selected>Pending ⏳</option>
                                        <option value="1">Completed ✔️</option>
                                    </select>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Selesai --}}
                <div id="selesai" class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h2 class="text-lg font-semibold text-green-600 mb-4 text-center">🎉 Selesai</h2>

                    @if ($tasksSelesai->isEmpty())
                        <p class="text-gray-500 italic text-center">Belum ada tugas selesai ✨</p>
                    @else
                        <ul id="listSelesai" class="space-y-4">
                            @foreach ($tasksSelesai as $task)
                                <li id="task-{{ $task->id }}" class="flex justify-between items-center bg-green-100 p-3 rounded-xl shadow-sm">
                                    <span class="font-medium text-gray-700 line-through">{{ $task->title }}</span>
                                    <select class="task-status bg-white border border-gray-300 px-2 py-1 rounded-lg shadow-sm"
                                        data-id="{{ $task->id }}">
                                        <option value="0">Pending ⏳</option>
                                        <option value="1" selected>Completed ✔️</option>
                                    </select>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.task-status').change(function() {
                let taskId = $(this).data('id');
                let status = $(this).val();

                $.ajax({
                    url: '/tasks/' + taskId + '/status',
                    type: 'POST',
                    data: {
                        status: status,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        let taskItem = $('#task-' + taskId);

                        // Pindahkan task ke list yang sesuai
                        if(status == 1){
                            // ke selesai
                            taskItem.fadeOut(function() {
                                taskItem.appendTo('#listSelesai').fadeIn();
                                taskItem.find('span').addClass('line-through text-gray-700');
                            });
                        } else {
                            // ke belum selesai
                            taskItem.fadeOut(function() {
                                taskItem.appendTo('#listBelumSelesai').fadeIn();
                                taskItem.find('span').removeClass('line-through text-gray-700');
                            });
                        }
                    },
                    error: function() {
                        alert('Error: Status gagal diupdate');
                    }
                });
            });
        });
    </script>
</x-app-layout>

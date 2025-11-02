<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Menampilkan dashboard utama dengan daftar tugas
    public function dashboard()
    {
        $tasksBelum = Task::where('user_id', Auth::id())
            ->where('status', false)
            ->latest()
            ->get();

        $tasksSelesai = Task::where('user_id', Auth::id())
            ->where('status', true)
            ->latest()
            ->get();

        return view('dashboard', compact('tasksBelum', 'tasksSelesai'));
    }

    // Halaman form tambah tugas
    public function create()
    {
        return view('tasks.create');
    }

    // Simpan tugas baru
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable',
        'deadline' => 'nullable|date',
    ]);

    $validated['user_id'] = Auth::id();
    $validated['status'] = false; // false = belum selesai

    Task::create($validated);

    return redirect()->route('dashboard')->with('success', 'Tugas berhasil ditambahkan!');
}

    // Ubah status tugas (toggle selesai/belum)
    public function toggle(Task $task)
    {
        if ($task->user_id === Auth::id()) {
            $task->update(['status' => !$task->status]);
        }

        return redirect()->route('dashboard');
    }

    // Hapus tugas
    public function destroy(Task $task)
    {
        if ($task->user_id === Auth::id()) {
            $task->delete();
        }

        return redirect()->route('dashboard')->with('success', 'Tugas dihapus.');
    }

    public function apiIndex()
{
    $tasks = \App\Models\Task::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
    return response()->json([
        'success' => true,
        'user' => \Illuminate\Support\Facades\Auth::user()->name,
        'total_tasks' => $tasks->count(),
        'tasks' => $tasks
    ]);
}

}

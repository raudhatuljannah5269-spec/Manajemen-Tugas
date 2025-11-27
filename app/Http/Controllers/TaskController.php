<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    // Menampilkan dashboard utama dengan daftar tugas
    public function dashboard()
    {
        Log::info('Dashboard dibuka', [
            'user_id' => Auth::id()
        ]);

        $tasksBelum = Task::where('user_id', Auth::id())
            ->where('status', false)
            ->latest()
            ->get();

        $tasksSelesai = Task::where('user_id', Auth::id())
            ->where('status', true)
            ->latest()
            ->get();

        Log::info('Data task diambil', [
            'belum_selesai' => $tasksBelum->count(),
            'selesai' => $tasksSelesai->count()
        ]);

        return view('dashboard', compact('tasksBelum', 'tasksSelesai'));
    }

    // Halaman form tambah tugas
    public function create()
    {
        Log::info('Halaman create task dibuka', ['user_id' => Auth::id()]);
        return view('tasks.create');
    }

    // Simpan tugas baru
    public function store(Request $request)
    {
        Log::info('Request masuk ke store()', $request->all());

        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'deadline' => 'nullable|date',
            ]);

            $validated['user_id'] = Auth::id();
            $validated['status'] = false;

            $task = Task::create($validated);

            Log::info('Task berhasil dibuat', [
                'task_id' => $task->id,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('dashboard')
                ->with('success', 'Tugas berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error menyimpan task', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);

            return back()->with('error', 'Gagal menyimpan tugas.');
        }
    }

    // Ubah status tugas (toggle selesai/belum)
    public function toggle(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            Log::warning('User mencoba mengubah task yang bukan miliknya', [
                'task_id' => $task->id,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('dashboard');
        }

        $task->update(['status' => !$task->status]);

        Log::info('Status task diubah', [
            'task_id' => $task->id,
            'status_baru' => $task->status
        ]);

        return redirect()->route('dashboard');
    }

    // Update status task via AJAX
    public function updateStatus(Request $request, Task $task)
    {
        Log::info('AJAX update status diterima', [
            'task_id' => $task->id,
            'input_status' => $request->status,
        ]);

        if ($task->user_id === Auth::id()) {
            $task->status = $request->status;
            $task->save();

            Log::info('Status task berhasil diupdate via AJAX', [
                'task_id' => $task->id,
                'status' => $task->status
            ]);

            return response()->json(['success' => true, 'status' => $task->status]);
        }

        Log::warning('Akses AJAX tidak sah', [
            'task_id' => $task->id,
            'user_id' => Auth::id()
        ]);

        return response()->json(['success' => false], 403);
    }

    // Hapus tugas
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            Log::warning('User mencoba menghapus task yang bukan miliknya', [
                'task_id' => $task->id,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('dashboard')->with('error', 'Tidak bisa menghapus tugas.');
        }

        Log::info('Task dihapus', [
            'task_id' => $task->id,
            'user_id' => Auth::id()
        ]);

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Tugas dihapus.');
    }

    // API endpoint untuk daftar task (JSON)
    public function apiIndex()
    {
        Log::info('API task diakses', ['user_id' => Auth::id()]);

        $tasks = Task::where('user_id', Auth::id())->get();

        return response()->json([
            'success' => true,
            'user' => Auth::user()->name,
            'total_tasks' => $tasks->count(),
            'tasks' => $tasks
        ]);
    }

    public function index()
    {
        Log::info('Halaman daftar task dibuka', ['user_id' => Auth::id()]);

        $tasks = Task::where('user_id', Auth::id())->get();

        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            Log::warning('User mencoba melihat task orang lain', [
                'task_id' => $task->id,
                'user_id' => Auth::id()
            ]);
            abort(403);
        }

        Log::info('Task ditampilkan', [
            'task_id' => $task->id,
            'user_id' => Auth::id()
        ]);

        return view('tasks.show', compact('task'));
    }
}

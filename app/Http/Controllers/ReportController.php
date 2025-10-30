<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:pdf,docx|max:5120'
    ]);

    $path = $request->file('file')->store('reports', 'public');

    return back()->with('success', 'Laporan berhasil diupload! Lokasi: ' . $path);
}

}

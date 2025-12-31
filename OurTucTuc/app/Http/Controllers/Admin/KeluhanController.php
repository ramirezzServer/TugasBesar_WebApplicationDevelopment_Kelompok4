<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KeluhanController extends Controller
{
    /**
     * Tampilkan semua keluhan (admin only)
     */
    public function index(Request $request)
    {
        $query = Keluhan::with('penumpang')
            ->latest();

        // optional filter
        if ($request->filled('q')) {
            $query->where('nama_keluhan', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $keluhans = $query->paginate(10);

        return view('admin.keluhan.index', compact('keluhans'));
    }

    /**
     * Update status keluhan (admin only)
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['diajukan', 'diselesaikan'])],
        ]);

        $keluhan = Keluhan::findOrFail($id);
        $keluhan->update([
            'status' => $data['status'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Status keluhan berhasil diperbarui.');
    }
}

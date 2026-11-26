<?php

namespace App\Http\Controllers;

use App\Models\Dimension;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DimensionController extends Controller
{
    /**
     * menampilkan semua kategori milik user yang login.
     */
    public function index(Request $request)
    {
        $dimensions = $request->user()
            ->dimensions()
            ->withCount('charLogs')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar kategori berhasil diambil.',
            'data' => $dimensions,
        ]);
    }

    /**
     * menambahkan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dimensions', 'name')
                    ->where('user_id', $request->user()->id),
            ],
        ]);

        $dimension = $request->user()
            ->dimensions()
            ->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan.',
            'data' => $dimension,
        ], 201);
    }

    /**
     * menampilkan detail kategori.
     */
    public function show(Request $request, string $id)
    {
        $dimension = $request->user()
            ->dimensions()
            ->with('charLogs')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail kategori berhasil diambil.',
            'data' => $dimension,
        ]);
    }

    /**
     * mengubah kategori.
     */
    public function update(Request $request, string $id)
    {
        $dimension = $request->user()
            ->dimensions()
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dimensions', 'name')
                    ->where('user_id', $request->user()->id)
                    ->ignore($dimension->id),
            ],
        ]);

        $dimension->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui.',
            'data' => $dimension,
        ]);
    }

    /**
     * menghapus kategori.
     */
    public function destroy(Request $request, string $id)
    {
        $dimension = $request->user()
            ->dimensions()
            ->findOrFail($id);

        $dimension->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus.',
        ]);
    }
}

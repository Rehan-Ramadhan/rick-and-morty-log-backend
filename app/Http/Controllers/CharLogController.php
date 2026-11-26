<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CharLogController extends Controller
{
    /**
     * menampilkan semua karakter milik user yang login.
     * bisa difilter berdasarkan dimension_id.
     */
    public function index(Request $request)
    {
        $query = $request->user()
            ->charLogs()
            ->with('dimension');

        if ($request->filled('dimension_id')) {
            $request->validate([
                'dimension_id' => [
                    'integer',
                    Rule::exists('dimensions', 'id')
                        ->where('user_id', $request->user()->id),
                ],
            ]);

            $query->where('dimension_id', $request->dimension_id);
        }

        $charLogs = $query->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar karakter berhasil diambil.',
            'data' => $charLogs,
        ]);
    }

    /**
     * menampilkan detail satu karakter milik user.
     */
    public function show(Request $request, string $id)
    {
        $charLog = $request->user()
            ->charLogs()
            ->with('dimension')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail karakter berhasil diambil.',
            'data' => $charLog,
        ]);
    }

    /**
     * menambahkan karakter baru ke koleksi user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dimension_id' => [
                'required',
                'integer',
                Rule::exists('dimensions', 'id')
                    ->where('user_id', $request->user()->id),
            ],
            'title' => ['required', 'string', 'max:255'],
            'species' => ['nullable', 'string', 'max:255'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'notes' => ['nullable', 'string'],
        ]);

        // user_id otomatis mengikuti akun yang sedang login.
        $charLog = $request->user()
            ->charLogs()
            ->create($validated);

        $charLog->load('dimension');

        return response()->json([
            'success' => true,
            'message' => 'Karakter berhasil ditambahkan ke koleksi.',
            'data' => $charLog,
        ], 201);
    }

    /**
     * mengubah data karakter milik user.
     * mendukung PUT dan PATCH.
     */
    public function update(Request $request, string $id)
    {
        $charLog = $request->user()
            ->charLogs()
            ->findOrFail($id);

        $validated = $request->validate([
            'dimension_id' => [
                'sometimes',
                'required',
                'integer',
                Rule::exists('dimensions', 'id')
                    ->where('user_id', $request->user()->id),
            ],
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'species' => ['sometimes', 'nullable', 'string', 'max:255'],
            'image_url' => ['sometimes', 'nullable', 'url', 'max:2048'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ]);

        $charLog->update($validated);
        $charLog->load('dimension');

        return response()->json([
            'success' => true,
            'message' => 'Karakter berhasil diperbarui.',
            'data' => $charLog,
        ]);
    }

    /**
     * menghapus karakter milik user.
     */
    public function destroy(Request $request, string $id)
    {
        $charLog = $request->user()
            ->charLogs()
            ->findOrFail($id);

        $charLog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Karakter berhasil dihapus.',
        ]);
    }
}

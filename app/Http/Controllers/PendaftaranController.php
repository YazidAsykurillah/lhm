<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranModel;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
		// Validasi atau logika
		return response()->json(['message' => 'Form submitted successfully!']);
        /*$validatedData = $request->validate([
            'nama_jamaah' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before:today',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'umrah_id' => 'required|integer|min:1|max:999',
        ]);

        try {
            PendaftaranModel::createWithTabungan([
                'nama_jamaah' => $validatedData['nama_jamaah'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'no_hp' => $validatedData['no_hp'],
                'email' => $validatedData['email'],
            ], $validatedData['umrah_id']);

            return back()->with('success', 'Pendaftaran berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan pendaftaran: ' . $e->getMessage());
        }*/
    }
}
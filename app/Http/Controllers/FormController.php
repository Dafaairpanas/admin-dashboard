<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display the multi-step form
     */
    public function index()
    {
        return view('form.index');
    }

    /**
     * Handle form submission
     */
    public function submit(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'kategori_pengunjung' => 'required|in:perseorangan,b2b',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi_jabatan' => 'nullable|string|max:255',
            'jenis_bisnis' => 'required|array',
            'jenis_bisnis_lainnya' => 'nullable|string|max:255',
            'kebutuhan_furniture' => 'required|array',
            'detail_kebutuhan' => 'nullable|string',
            'estimasi_budget' => 'required|string',
            'estimasi_waktu' => 'nullable|string',
            'estimasi_jumlah' => 'nullable|array',
            'preferensi_brand' => 'nullable|array|max:2',
            'consent' => 'required|accepted',
        ]);

        // For now, just return success message
        // TODO: Save to database or send email
        return redirect()->route('form.index')->with('success', 'Terima kasih! Data Anda telah terkirim.');
    }
}

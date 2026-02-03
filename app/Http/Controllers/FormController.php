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
        $questions = \App\Models\Question::with([
            'refQuestionTranslations',
            'refTypeQuestion',
            'refQuestionOptions' => function ($q) {
                $q->orderBy('urutan');
            },
            'refQuestionOptions.refQuestionOptionTranslations'
        ])
            ->where('is_active', 1)
            ->orderBy('urutan')
            ->get();

        return view('form.index', compact('questions'));
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

        // Create Submission
        try {
            \App\Models\Submission::create([
                'survey_id' => 1, // Default or dynamic
                'full_name' => $validated['nama_lengkap'],
                'phone_number' => $validated['whatsapp'],
                'email' => $validated['email'],
                'kategori_pengunjung' => $validated['kategori_pengunjung'],
                'nama_perusahaan' => $validated['nama_perusahaan'] ?? null,
                'posisi_jabatan' => $validated['posisi_jabatan'] ?? null,
                'jenis_bisnis' => json_encode($validated['jenis_bisnis']), // Save as JSON
                'jenis_bisnis_lainnya' => $validated['jenis_bisnis_lainnya'] ?? null,
                'kebutuhan_furniture' => json_encode($validated['kebutuhan_furniture']), // Save as JSON
                'detail_kebutuhan' => $validated['detail_kebutuhan'] ?? null,
                'estimasi_budget' => $validated['estimasi_budget'],
                'estimasi_waktu' => $validated['estimasi_waktu'] ?? null,
                'estimasi_jumlah' => isset($validated['estimasi_jumlah']) ? json_encode($validated['estimasi_jumlah']) : null,
                'preferensi_brand' => isset($validated['preferensi_brand']) ? json_encode($validated['preferensi_brand']) : null,
                'consent' => 1,
            ]);

            return redirect()->route('form.index')->with('success', 'Terima kasih! Data Anda telah terkirim.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')->withInput();
        }
    }
}

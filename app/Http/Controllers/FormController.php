<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\QVisitorCategory;
use App\Models\VisitorCategoryTranslation;
use App\Models\Languages;

class FormController extends Controller
{
    /**
     * Display the multi-step form
     */
    public function index(Request $request)
    {
        // Ambil bahasa dari berbagai sumber dengan prioritas
        $lang = $request->input('lang')
                ?? $request->cookie('selected_language')
                ?? session('selected_language')
                ?? 'en';

        $params = (object) [
            'search_value' => $request->search_value ?? null,
            'show_data' => $request->show_data ?? 15,
            'lang' => $lang,
        ];

        $visitors = QVisitorCategory::getAll($params);
        $languages = Languages::where('is_active', 1)->get();

        // Ambil semua translations untuk kategori visitor
        $master_visitor_category_translations = collect();
        foreach ($visitors['items'] as $visitor) {
            $translations = VisitorCategoryTranslation::where('visitor_category_id', $visitor['id'])->get();
            $master_visitor_category_translations = $master_visitor_category_translations->merge($translations);
        }

        return view('form.index', [
            'visitors' => $visitors['items'],
            'languages' => $languages,
            'current_lang' => $lang,
            'master_visitor_category_translations' => $master_visitor_category_translations,
        ]);
    }
    /**
     * Handle form submission
     */
    public function submit(Request $request)
    {
        try {
            // Prepare data
            $params = [
                'survey_id' => $request->input('survey_id'), // Optional
                'full_name' => $request->input('full_name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'visitor_category_id' => $request->input('kategori_pengunjung'),
                'company_name' => $request->input('company_name'),
                'job_title' => $request->input('job_title'),
                'business_type' => $request->input('business_type'),
            ];

            // Save submission
            $result = QSubmission::saveData($params);

            return redirect()
                ->back()
                ->with('success', 'Data berhasil dikirim! Terima kasih telah mengisi form.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Languages;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search_value;
        $query = Languages::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
        }

        $languages = $query->orderBy('name')->paginate($request->show_data ?? 15);

        return view('pages.language.index', [
            'data' => $languages,
            'search' => $search
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:10|unique:languages,code',
            'name' => 'required|string|max:100',
            'is_default' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle Default Logic: If new language is default, unset others
        if ($request->has('is_default') && $request->is_default) {
            Languages::where('is_default', 1)->update(['is_default' => 0]);
        }

        Languages::create([
            'code' => $request->code,
            'name' => $request->name,
            'is_default' => $request->has('is_default') ? 1 : 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('languages.index')->with('success', 'Language created successfully');
    }

    public function update(Request $request, $id)
    {
        $language = Languages::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:10|unique:languages,code,' . $id,
            'name' => 'required|string|max:100',
            'is_default' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle Default Logic
        if ($request->has('is_default') && $request->is_default) {
            Languages::where('is_default', 1)->where('id', '!=', $id)->update(['is_default' => 0]);
        }

        // If unsetting default, ensure atleast one default exists? 
        // For now allow simple toggle.

        $language->update([
            'code' => $request->code,
            'name' => $request->name,
            'is_default' => $request->has('is_default') ? 1 : 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('languages.index')->with('success', 'Language updated successfully');
    }

    public function destroy($id)
    {
        $language = Languages::findOrFail($id);

        if ($language->is_default) {
            return redirect()->back()->with('error', 'Cannot delete the default language.');
        }

        $language->delete();

        return redirect()->route('languages.index')->with('success', 'Language deleted successfully');
    }
}

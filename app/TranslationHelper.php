<?php

namespace App;

use App\Models\VisitorCategoryTranslation;

class TranslationHelper
{
    public static function getVisitorCategoryName($categoryId, $lang = 'en')
    {
        $translation = VisitorCategoryTranslation::where('visitor_category_id', $categoryId)
            ->where('language_code', $lang)
            ->first();

        return $translation ? $translation->name : null;
    }
}

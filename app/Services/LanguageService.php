<?php

namespace App\Services;
use App\Models\Language;


class LanguageService
{
    public static function getLanguages()
    {
        return Language::active()->orderBy('is_default', 'desc')->get();
    }

    public static function getDefaultLanguage(array $columns = ['name', 'code', 'encoding', 'is_default'])
    {
        return Language::active()->isDefault()->select($columns)->first();
    }

    public static function getCodeDefault()
    {
        return Language::active()->isDefault()->value('code');
    }

    public static function getCodeNotDefault()
    {
        return Language::active()->isNotDefault()->value('code');
    }

    public static function getCodes()
    {
        return Language::active()->orderBy('is_default', 'desc')->select('code')->get();
    }
}
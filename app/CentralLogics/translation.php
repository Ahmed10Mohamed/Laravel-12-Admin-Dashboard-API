<?php

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
if (!function_exists('translate')) {

    /**
     * Translate a given key and automatically add/store translations for all languages.
     * Auto-detects source language, translates to current locale,
     * and saves translations across all language files.
     *
     * @param string $key The key or text to translate
     * @return string Translated text
     */
    function translate(string $key): string
    {
        // Use file cache driver
        Cache::setDefaultDriver('file');

        // Current app locale
        $local = app()->getLocale();
        App::setLocale($local);

        // Path to current locale file
        $langPath = base_path("lang/{$local}/messages.php");
        $langArray = file_exists($langPath) ? include($langPath) : [];

        // Clean and normalize input text
        $processed = ucfirst(str_replace('_', ' ', remove_invalid_charcaters($key)));

        // If translation already exists → return it immediately
        if (array_key_exists($key, $langArray)) {
            return __('messages.' . $key);
        }

        // Create Google Translate instance
        $translator = new GoogleTranslate();

        // Cache key for saving translation for the current locale
        $cacheKeyCurrent = "trans_auto_detect_{$key}_to_{$local}";

        // Translate text to current locale (Auto Detect source language)
        $translatedCurrent = Cache::rememberForever($cacheKeyCurrent, function () use ($processed, $local, $translator): string {
            try {
                return $translator->setSource()   // auto-detect language
                                  ->setTarget($local)
                                  ->translate($processed);
            } catch (\Throwable $e) {
                \Log::error('Translation current locale failed', [
                    'to' => $local,
                    'error' => $e->getMessage()
                ]);
                return $processed; // fallback
            }
        });

        // Save translated text in current locale file
        $langArray[$key] = $translatedCurrent;
        file_put_contents($langPath, "<?php return " . var_export($langArray, true) . ";");

        // Translate into all other languages
        $languages = array_diff(scandir(base_path('lang')), ['.', '..']);

        foreach ($languages as $targetLang) {
            if (!is_dir(base_path("lang/{$targetLang}"))) continue;

            $targetPath = base_path("lang/{$targetLang}/messages.php");
            $targetArray = file_exists($targetPath) ? include($targetPath) : [];

            // Skip if already translated
            if (array_key_exists($key, $targetArray)) continue;

            // Cache key for each translation
            $cacheKey = "trans_auto_detect_{$key}_to_{$targetLang}";

            // Translate text to each language
            $translated = Cache::rememberForever($cacheKey, function () use ($processed, $targetLang, $translator): string {
                try {
                    return $translator->setSource()     // auto-detect source
                                      ->setTarget($targetLang)
                                      ->translate($processed);
                } catch (\Throwable $e) {
                    \Log::error('Translation failed', [
                        'to' => $targetLang,
                        'error' => $e->getMessage()
                    ]);
                    return $processed; // fallback
                }
            });

            // Save translation in the target language file
            $targetArray[$key] = $translated;
            file_put_contents($targetPath, "<?php return " . var_export($targetArray, true) . ";");
        }

        return $translatedCurrent;
    }
}


if (!function_exists('slug')) {
    /**
     * Generate a URL-friendly slug from a title.
     *
     * @param string $title The text to convert to slug
     * @param string $language Optional language code (default: 'en')
     * @param string $separator Optional word separator (default: '-')
     * @return string Slugified version of the text
     */
    function slug(string $title, string $language = 'en', string $separator = '-'): string
    {
        // Remove invalid characters from the title
        $title = remove_invalid_charcaters($title);

        // Replace spaces with the separator
        $slug = preg_replace('/\s+/', $separator, $title);

        // Trim separators from both ends
        $slug = trim($slug, $separator);

        // Convert to lowercase
        return strtolower($slug);
    }
}





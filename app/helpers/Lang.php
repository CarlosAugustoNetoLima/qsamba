<?php

/**
 * Lang — lightweight i18n helper for Q'SAMBA.
 *
 * Usage:
 *   Lang::load('en');          // call once per request (in controller)
 *   echo __('nav.tickets');    // returns translated string
 *   echo __('ticker.n', ['n' => '16 MAIO']);  // with placeholder replacement
 */
class Lang
{
    /** @var array<string,string> */
    private static array $strings = [];

    /** @var string */
    private static string $locale = 'pt';

    /**
     * Loads the language file for the given locale.
     * Falls back to Portuguese if the file doesn't exist.
     */
    public static function load(string $locale): void
    {
        self::$locale = $locale;

        $file = BASE_PATH . '/app/lang/' . $locale . '.php';

        if (!file_exists($file)) {
            $file = BASE_PATH . '/app/lang/pt.php';
            self::$locale = 'pt';
        }

        self::$strings = require $file;
    }

    /**
     * Returns the translated string for the given dot-notation key.
     * Supports :placeholder replacement.
     *
     * @param string               $key
     * @param array<string,string> $replace
     */
    public static function get(string $key, array $replace = []): string
    {
        $value = self::$strings[$key] ?? $key;

        foreach ($replace as $search => $repl) {
            $value = str_replace(':' . $search, $repl, $value);
        }

        return $value;
    }

    /** Returns the active locale code (e.g. 'pt', 'en'). */
    public static function getLocale(): string
    {
        return self::$locale;
    }

    /**
     * Formats a price based on locale.
     * Converts Euro to Dollar if locale is 'en' (1.1x approx).
     * 
     * @param float|int $amount
     * @param string    $currency 'Kz', '€', etc.
     */
    public static function money($amount, string $currency = '€'): string
    {
        $locale = self::$locale;

        // Force Euro as requested by user
        $effectiveCurrency = '€';

        $thousandSep = ($locale === 'pt') ? '.' : ',';
        $decimalSep  = ($locale === 'pt') ? ',' : '.';
        $decimals    = 0;

        $formatted = number_format($amount, $decimals, $decimalSep, $thousandSep);

        return $effectiveCurrency . $formatted;
    }

    /**
     * Formats a date string (Y-m-d) to locale format.
     * Example: 2026-05-16 -> 16 Maio 2026 (PT) or 16 May 2026 (EN)
     */
    public static function date(string $dateStr, bool $short = false): string
    {
        $time = strtotime($dateStr);
        if (!$time) return $dateStr;

        $day   = date('j', $time);
        $monthNum = date('n', $time);
        $year  = date('Y', $time);

        $month = self::get("month.$monthNum");
        if ($short) {
            $month = mb_substr($month, 0, 3);
        }

        return "$day $month $year";
    }
}

/**
 * Global shortcut: __('key') === Lang::get('key')
 *
 * @param string               $key
 * @param array<string,string> $replace
 */
function __(string $key, array $replace = []): string
{
    return Lang::get($key, $replace);
}

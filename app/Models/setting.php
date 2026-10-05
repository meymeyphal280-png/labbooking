<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'setting_key',
        'setting_value',
    ];

    /**
     * Get a setting value.
     */
    public static function get(string $key, $default = null)
    {
        return static::where('setting_key', $key)
            ->value('setting_value') ?? $default;
    }

    /**
     * Set or update a setting.
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(
            ['setting_key' => $key],
            ['setting_value' => $value]
        );
    }

    /**
     * Get a boolean setting.
     */
    public static function isEnabled(string $key, bool $default = false): bool
    {
        $value = static::get($key, $default ? '1' : '0');

        return in_array(
            strtolower((string) $value),
            ['1', 'true', 'yes', 'on'],
            true
        );
    }

    /**
     * Get an integer setting.
     */
    public static function integer(string $key, int $default = 0): int
    {
        return (int) static::get($key, $default);
    }
}
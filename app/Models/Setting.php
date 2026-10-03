<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Cache container for settings.
     */
    protected static ?array $settingsCache = null;

    /**
     * Retrieve a setting by key with optional default fallback.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        if (static::$settingsCache === null) {
            try {
                static::$settingsCache = static::pluck('value', 'key')->toArray();
            } catch (\Throwable $e) {
                return $default;
            }
        }

        return static::$settingsCache[$key] ?? $default;
    }

    /**
     * Set or update a setting.
     */
    public static function set(string $key, mixed $value, string $group = 'general'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        if (static::$settingsCache !== null) {
            static::$settingsCache[$key] = $value;
        }

        return $setting;
    }
}

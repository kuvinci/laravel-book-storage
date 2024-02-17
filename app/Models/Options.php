<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Options extends Model
{
    protected $fillable = ['key', 'value'];

    public static function setOption($key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);

        Cache::forget('options_cache');
    }
}

<?php

namespace App\Providers;

use App\Models\Options;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class OptionsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $options = Cache::remember('options_cache', 60*60, function () {
            return Options::all()->pluck('value', 'key')->toArray();
        });

        config(['options' => $options]);
    }
}

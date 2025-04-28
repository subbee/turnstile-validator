<?php

namespace TurnstileValidator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Blade;


class TurnstileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'turnstile');

        // Config publish
        $this->publishes([
            __DIR__.'/../config/turnstile.php' => config_path('turnstile.php'),
        ], 'config');

        // Validator
        Validator::extend('turnstile', function ($attribute, $value, $parameters, $validator) {
            return TurnstileValidator::verify($value);
        }, __('turnstile::validation.turnstile_failed'));

        Blade::directive('turnstile', function () {
            $siteKey = config('turnstile.sitekey');

            return <<<HTML
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<div class="cf-turnstile" data-sitekey="{$siteKey}"></div>
HTML;
        });
        
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/turnstile.php', 'turnstile'
        );
    }
}

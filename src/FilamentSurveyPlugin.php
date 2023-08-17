<?php

namespace Tapp\FilamentSurvey;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentSurveyPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-survey';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources(
                config('filament-survey.resources')
            );
    }

    public function boot(Panel $panel): void
    {
        //
    }
}

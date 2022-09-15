<?php

namespace Tapp\FilamentSurvey;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentSurveyServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-survey';

    protected function getResources(): array
    {
        return config('filament-survey.resources');
    }

    public function configurePackage(Package $package): void
    {
        parent::configurePackage($package);

        $package->name('filament-survey')
            ->hasConfigFile('filament-survey')
            ->hasViews('filament-survey')
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        //
    }
}

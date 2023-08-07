<?php

namespace Tapp\FilamentSurvey;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSurveyServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-survey';

    public function configurePackage(Package $package): void
    {
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

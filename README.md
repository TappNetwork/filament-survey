# Filament Laravel Survey

A Filament plugin for [Laravel Survey](https://github.com/matt-daneshvar/laravel-survey) package.

This package provides Filament resources for [Laravel Survey](https://github.com/matt-daneshvar/laravel-survey).

## Requirements
- PHP 8.1
- [Filament 3](https://github.com/laravel-filament/filament)

## Dependencies
- [maatwebsite/excel](https://github.com/SpartnerNL/Laravel-Excel)
- [matt-daneshvar/laravel-survey](https://github.com/matt-daneshvar/laravel-survey)
- [spatie/eloquent-sortable](https://github.com/spatie/eloquent-sortable)

## Installation

### Installing required packages

This plugin uses [Spatie translatable](https://spatie.be/docs/laravel-translatable/v6/installation-setup), [Spatie translatable plugin](https://filamentphp.com/plugins/filament-spatie-translatable), [Laravel Excel](https://github.com/SpartnerNL/Laravel-Excel), and [Eloquent Sortable](https://github.com/spatie/eloquent-sortable) packages.

First install and configure these packages.

It also uses a modified version of [Laravel Survey](https://github.com/matt-daneshvar/laravel-survey) package. Please refer to the installation instructions below.

### Installing Laravel Survey package

This plugin uses a modifed version of Laravel Survey: https://github.com/tappnetwork/laravel-survey/tree/translatable that adds translatable and sortable fields to the survey models. More details in this PR: [matt-daneshvar/laravel-survey#39](https://github.com/matt-daneshvar/laravel-survey/pull/39).

So you must install this version instead of requiring `matt-daneshvar/laravel-survey`. In order to do so, add to your project's `composer.json`:

```php
"require": {
    ...
    "matt-daneshvar/laravel-survey": "dev-translatable",
},

"repositories": [
    ...
    {
        "type": "vcs",
        "url": "https://github.com/TappNetwork/laravel-survey"
    }
],
```

Publish the package migrations

```bash
php artisan vendor:publish --provider="MattDaneshvar\Survey\SurveyServiceProvider" --tag="migrations"
```

Run the migrations

```bash
php artisan migrate
```

### Installing Filament Survey plugin

Install the plugin via Composer:

```bash
composer require tapp/filament-survey:"^3.0"
```

> **Note** 
> For **Filament 2.x** check the **[2.x](https://github.com//TappNetwork/filament-survey/tree/2.x)** branch

You can publish the view file with:

```bash
php artisan vendor:publish --tag="filament-survey-views"
```

You can publish the translations files with:

```bash
php artisan vendor:publish --tag="filament-survey-translations"
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-survey-config"
```

### Adding the plugin to a panel

Add this plugin to a panel on `plugins()`method. E.g. in  `app/Providers/Filament/AdminPanelProvider.php`:

```php
use Tapp\FilamentSurvey\FilamentSurveyPlugin;
 
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            FilamentSurveyPlugin::make(),
            //...
        ]);
}
```

This plugin requires the Spatie Translatable plugin, so it should also be added on a panel like so:

```php
use Filament\SpatieLaravelTranslatablePlugin;
use Tapp\FilamentSurvey\FilamentSurveyPlugin;
 
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            FilamentSurveyPlugin::make(),
            SpatieLaravelTranslatablePlugin::make(),
            //...
        ]);
}
```

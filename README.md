# Filament Laravel Survey

A Filament plugin for [Laravel Survey](https://github.com/matt-daneshvar/laravel-survey) package.

This package provides Filament resources for [Laravel Survey](https://github.com/matt-daneshvar/laravel-survey).

## Requirements
- PHP 8
- [Filament 2](https://github.com/laravel-filament/filament)

## Dependencies
- [maatwebsite/excel](https://github.com/SpartnerNL/Laravel-Excel)
- [matt-daneshvar/laravel-survey](https://github.com/matt-daneshvar/laravel-survey)
- [spatie/eloquent-sortable](https://github.com/spatie/eloquent-sortable)

## Installation

You can install the plugin via composer:

```bash
composer require tapp/filament-survey
```

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

This is the content of the published config file:

```php
<?php

return [

    'resources' => [
        'AnswerResource' => \Tapp\FilamentSurvey\Resources\AnswerResource::class,
        'EntryResource' => \Tapp\FilamentSurvey\Resources\EntryResource::class,
        'QuestionResource' => \Tapp\FilamentSurvey\Resources\QuestionResource::class,
        'SectionResource' => \Tapp\FilamentSurvey\Resources\SectionResource::class,
        'SurveyResource' => \Tapp\FilamentSurvey\Resources\SurveyResource::class,
    ],

    'languages' => [
        'en' => 'English',
        'es' => 'Spanish',
    ],

    'navigation' => [
        'answer' => [
            'sort' => 4,
            'icon' => 'heroicon-o-reply',
        ],
        'entry' => [
            'sort' => 5,
            'icon' => 'heroicon-o-view-list',
        ],
        'question' => [
            'sort' => 3,
            'icon' => 'heroicon-o-question-mark-circle',
        ],
        'section' => [
            'sort' => 2,
            'icon' => 'heroicon-o-folder-open',
        ],
        'survey' => [
            'sort' => 1,
            'icon' => 'heroicon-o-collection',
        ],
    ],

];
```

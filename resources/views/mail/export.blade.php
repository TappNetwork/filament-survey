@component('mail::message')
# {{ __('Export Completed') }}

{{ __('See the attached file for your export.') }}

{{ __('Thanks') }},<br>
{{ config('app.name') }}
@endcomponent

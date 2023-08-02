<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('greater_than_field', function ($attribute, $value, $parameters, $validator) {
            $otherField = $parameters[0];
            $data = $validator->getData();
            return isset($data[$otherField]) && $value > $data[$otherField];
        });
        Validator::replacer('greater_than_field', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must be greater than price min.');
        });
        Validator::extend('less_than_field', function ($attribute, $value, $parameters, $validator) {
            $otherField = $parameters[0];
            $data = $validator->getData();
            return isset($data[$otherField]) && $value < $data[$otherField];
        });
        Validator::replacer('less_than_field', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must be less than price max.');
        });
        Validator::extend('greater_than_today', function ($attribute, $value, $parameters, $validator) {
            $today = Carbon::today();
            return $value > $today;
        });
    
        Validator::replacer('greater_than_today', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must be greater than today.');
        });
    }
}

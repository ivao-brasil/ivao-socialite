<?php

namespace IvaoSocialite;

use Illuminate\Support\ServiceProvider;

class IvaoSocialiteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'ivao',
            function ($app) use ($socialite) {
                $config = $app['config']['services.ivao'];
                return $socialite->buildProvider(IvaoProvider::class, $config);
            }
        );
    }
}
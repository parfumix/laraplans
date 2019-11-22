<?php

namespace Parfumux\Laraplans;

use Illuminate\Support\ServiceProvider;
use Parfumux\Laraplans\SubscriptionBuilder;
use Parfumux\Laraplans\SubscriptionResolver;
use Parfumux\Laraplans\Contracts\PlanInterface;
use Parfumux\Laraplans\Contracts\PlanFeatureInterface;
use Parfumux\Laraplans\Contracts\PlanSubscriptionInterface;
use Parfumux\Laraplans\Contracts\SubscriptionBuilderInterface;
use Parfumux\Laraplans\Contracts\SubscriptionResolverInterface;
use Parfumux\Laraplans\Contracts\PlanSubscriptionUsageInterface;

class LaraplansServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laraplans');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/laraplans.php' => config_path('laraplans.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../lang' => resource_path('lang/vendor/laraplans'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laraplans.php', 'laraplans');

        $this->app->bind(PlanInterface::class, config('laraplans.models.plan'));
        $this->app->bind(PlanFeatureInterface::class, config('laraplans.models.plan_feature'));
        $this->app->bind(PlanSubscriptionInterface::class, config('laraplans.models.plan_subscription'));
        $this->app->bind(PlanSubscriptionUsageInterface::class, config('laraplans.models.plan_subscription_usage'));
        $this->app->bind(SubscriptionBuilderInterface::class, SubscriptionBuilder::class);
        $this->app->bind(SubscriptionResolverInterface::class, SubscriptionResolver::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        //
    }
}

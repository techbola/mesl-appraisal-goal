<?php

namespace Cavidel\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'layouts.header',
            'Cavidel\Http\ViewComposers\SidebarComposer'
        );
        view()->composer(
            'layouts.uikit',
            'Cavidel\Http\ViewComposers\SidebarComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

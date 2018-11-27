<?php

namespace MESL\Providers;

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
            'layouts.header_',
            'MESL\Http\ViewComposers\SidebarComposer'
        );
        view()->composer(
            'layouts.uikit',
            'MESL\Http\ViewComposers\SidebarComposer'
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

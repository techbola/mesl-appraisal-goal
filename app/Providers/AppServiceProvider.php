<?php

namespace Cavidel\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Schema::defaultStringLength(191);

         Blade::directive('emptylist', function ($text) {
          return
          '<div class="text-center m-t-20 m-b-20">
            <img src="{{ asset("images/site/emptylist.svg") }}" alt="" width="100px" style="filter:grayscale(1);width: 27%;max-width:100px;opacity: 0.7;">
            <div class="f16 m-t-10 text-muted">
              '.($text? $text : 'Nothing to display').'
            </div>
          </div>';
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace Aaix\LaravelTallArchitect;

use Aaix\LaravelTallArchitect\Commands\StatusCmd;
use Illuminate\Support\ServiceProvider;

class TallArchitectServiceProvider extends ServiceProvider
{
   public function register(): void
   {
      $this->mergeConfigFrom(__DIR__ . '/../config/tall-architect.php', 'tall-architect');

      $this->app->singleton(GuidelineRegistry::class);
   }

   public function boot(): void
   {
      if (!$this->app->runningInConsole()) {
         return;
      }

      $this->commands([
         StatusCmd::class,
      ]);

      $this->publishes(
         [
            __DIR__ . '/../config/tall-architect.php' => config_path('tall-architect.php'),
         ],
         'tall-architect-config',
      );
   }
}

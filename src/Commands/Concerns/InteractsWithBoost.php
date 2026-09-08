<?php

namespace Aaix\LaravelTallArchitect\Commands\Concerns;

trait InteractsWithBoost
{
   protected const PACKAGE = 'aaix/laravel-tall-architect';

   protected function boostIsInstalled(): bool
   {
      return class_exists(\Laravel\Boost\BoostServiceProvider::class);
   }

   protected function boostIsConfigured(): bool
   {
      return is_file(base_path('boost.json'));
   }

   protected function boostKnowsThisPackage(): bool
   {
      if (!$this->boostIsConfigured()) {
         return false;
      }

      $config = json_decode((string) file_get_contents(base_path('boost.json')), true);

      if (!is_array($config)) {
         return false;
      }

      return in_array(self::PACKAGE, (array) ($config['packages'] ?? []), true);
   }

   protected function warnAboutMissingBoost(): void
   {
      $this->components->warn('Laravel Boost is not installed. The guidelines cannot be composed into your agent files.');
      $this->components->bulletList(['composer require laravel/boost --dev', 'php artisan boost:install']);
   }

   protected function refreshAgentFiles(): int
   {
      if (!$this->boostIsInstalled()) {
         $this->warnAboutMissingBoost();

         return self::FAILURE;
      }

      if (!$this->boostIsConfigured()) {
         $this->components->warn('Laravel Boost is installed but not set up yet. Run [php artisan boost:install] once.');

         return self::FAILURE;
      }

      $arguments = $this->boostKnowsThisPackage() ? [] : ['--discover' => true];

      return $this->call('boost:update', $arguments);
   }
}

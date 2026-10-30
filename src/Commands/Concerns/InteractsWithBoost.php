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
}

<?php

namespace Aaix\LaravelTallArchitect\Tests;

use Aaix\LaravelTallArchitect\TallArchitectServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
   protected function getPackageProviders($app): array
   {
      return [TallArchitectServiceProvider::class];
   }

   protected function fixturePath(): string
   {
      return __DIR__ . '/fixtures/guidelines';
   }

   protected function useFixtureGuidelines(): void
   {
      config()->set('tall-architect.path', $this->fixturePath());
   }
}

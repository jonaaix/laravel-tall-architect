<?php

namespace Aaix\LaravelTallArchitect\Tests\Feature;

use Aaix\LaravelTallArchitect\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CommandsTest extends TestCase
{
   protected function setUp(): void
   {
      parent::setUp();

      $this->useFixtureGuidelines();
   }

   #[Test]
   public function status_lists_every_guideline_with_its_state(): void
   {
      $this->artisan('tall-architect:status')
         ->expectsOutputToContain('TALL Architect')
         ->expectsOutputToContain('Non-technical User Mode')
         ->assertSuccessful();
   }

   #[Test]
   public function sync_fails_while_boost_is_not_set_up(): void
   {
      $this->assertFileDoesNotExist(base_path('boost.json'));

      $this->artisan('tall-architect:sync')
         ->expectsOutputToContain('boost:install')
         ->assertFailed();
   }

   #[Test]
   public function sync_fails_when_no_guideline_is_active(): void
   {
      config()->set('tall-architect.strict', false);
      config()->set('tall-architect.guidelines', array_fill_keys(
         ['tall-architect', 'planning', 'design-system', 'ux-principles', 'nontech-user'],
         false,
      ));

      $this->artisan('tall-architect:sync')
         ->expectsOutputToContain('Nothing to sync')
         ->assertFailed();
   }
}

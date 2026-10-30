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
         ->expectsOutputToContain('Feature Book')
         ->expectsOutputToContain('Skill: feature-book-audit')
         ->expectsOutputToContain('Skill: feature-book ')
         ->assertSuccessful();
   }
}

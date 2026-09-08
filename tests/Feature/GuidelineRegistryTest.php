<?php

namespace Aaix\LaravelTallArchitect\Tests\Feature;

use Aaix\LaravelTallArchitect\GuidelineRegistry;
use Aaix\LaravelTallArchitect\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class GuidelineRegistryTest extends TestCase
{
   protected GuidelineRegistry $registry;

   protected function setUp(): void
   {
      parent::setUp();

      $this->useFixtureGuidelines();

      $this->registry = $this->app->make(GuidelineRegistry::class);
   }

   #[Test]
   public function it_knows_every_shipped_guideline(): void
   {
      $this->assertSame(
         ['tall-architect', 'planning', 'design-system', 'ux-principles', 'nontech-user'],
         $this->registry->all()->keys()->all(),
      );
   }

   #[Test]
   public function it_enables_the_required_guidelines_by_default(): void
   {
      $this->assertSame(
         ['tall-architect', 'planning', 'design-system', 'ux-principles'],
         $this->registry->enabled()->keys()->all(),
      );
   }

   #[Test]
   public function it_enables_an_optional_guideline_when_configured(): void
   {
      config()->set('tall-architect.guidelines.nontech-user', true);

      $this->assertContains('nontech-user', $this->registry->enabled()->keys()->all());
   }

   #[Test]
   public function it_ignores_a_disabled_required_guideline_in_strict_mode(): void
   {
      config()->set('tall-architect.guidelines.planning', false);

      $this->assertContains('planning', $this->registry->enabled()->keys()->all());
   }

   #[Test]
   public function it_allows_disabling_a_required_guideline_outside_strict_mode(): void
   {
      config()->set('tall-architect.strict', false);
      config()->set('tall-architect.guidelines.planning', false);

      $this->assertNotContains('planning', $this->registry->enabled()->keys()->all());
   }

   #[Test]
   public function it_composes_the_enabled_guidelines_in_order(): void
   {
      config()->set('tall-architect.guidelines.nontech-user', true);

      $composed = $this->registry->compose();

      $this->assertStringContainsString('Content of the tall-architect guideline.', $composed);
      $this->assertStringContainsString('Content of the nontech-user guideline.', $composed);
      $this->assertLessThan(
         strpos($composed, '# planning'),
         strpos($composed, '# tall-architect'),
      );
   }

   #[Test]
   public function it_skips_empty_guidelines(): void
   {
      file_put_contents($this->fixturePath() . '/design-system.md', '');

      try {
         $this->assertNotContains('design-system', $this->registry->enabled()->keys()->all());
      } finally {
         file_put_contents($this->fixturePath() . '/design-system.md', "# design-system\n\nContent of the design-system guideline.\n");
      }
   }
}

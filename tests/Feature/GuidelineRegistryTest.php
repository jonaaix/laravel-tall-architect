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
   public function it_enables_the_default_set(): void
   {
      $this->assertSame(
         ['tall-architect', 'planning', 'design-system', 'ux-principles', 'nontech-user'],
         $this->registry->enabled()->keys()->all(),
      );
   }

   #[Test]
   public function it_re_enables_a_guideline_the_project_switched_off(): void
   {
      config()->set('tall-architect.guidelines.nontech-user', false);
      $this->assertNotContains('nontech-user', $this->registry->enabled()->keys()->all());

      config()->set('tall-architect.guidelines.nontech-user', true);
      $this->assertContains('nontech-user', $this->registry->enabled()->keys()->all());
   }

   #[Test]
   public function it_allows_disabling_any_guideline(): void
   {
      foreach (array_keys(GuidelineRegistry::TITLES) as $key) {
         config()->set('tall-architect.guidelines.' . $key, false);

         $this->assertNotContains($key, $this->registry->enabled()->keys()->all());

         config()->set('tall-architect.guidelines.' . $key, true);
      }
   }

   #[Test]
   public function it_falls_back_to_the_shipped_default_for_an_unlisted_guideline(): void
   {
      config()->set('tall-architect.guidelines', []);

      $this->assertSame(
         ['tall-architect', 'planning', 'design-system', 'ux-principles', 'nontech-user'],
         $this->registry->enabled()->keys()->all(),
      );
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

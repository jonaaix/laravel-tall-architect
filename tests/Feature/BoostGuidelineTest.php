<?php

namespace Aaix\LaravelTallArchitect\Tests\Feature;

use Aaix\LaravelTallArchitect\TallArchitectServiceProvider;
use Aaix\LaravelTallArchitect\Tests\TestCase;
use Illuminate\Support\Facades\Blade;
use PHPUnit\Framework\Attributes\Test;

class BoostGuidelineTest extends TestCase
{
   #[Test]
   public function guidelines_publish_under_the_project_namespace(): void
   {
      $paths = TallArchitectServiceProvider::pathsToPublish(
         TallArchitectServiceProvider::class,
         'tall-architect-guidelines',
      );

      $this->assertSame([base_path('.ai/project/tall-architect')], array_values($paths));
      $this->assertFileExists(array_key_first($paths) . '/feature-docs.md');
   }

   protected function setUp(): void
   {
      parent::setUp();

      $this->useFixtureGuidelines();
   }

   protected function boostResourcePath(string $path = ''): string
   {
      return __DIR__ . '/../../resources/boost/' . ltrim($path, '/');
   }

   #[Test]
   public function boost_discovers_the_guideline_and_the_skill_at_the_expected_paths(): void
   {
      $this->assertDirectoryExists($this->boostResourcePath('guidelines'));
      $this->assertFileExists($this->boostResourcePath('guidelines/tall-architect.blade.php'));
      $this->assertFileExists($this->boostResourcePath('skills/ui-patterns/SKILL.md'));
      $this->assertFileExists($this->boostResourcePath('skills/feature-docs/SKILL.md'));
      $this->assertFileExists($this->boostResourcePath('skills/feature-audit/SKILL.md'));
   }

   #[Test]
   public function only_one_guideline_file_is_shipped(): void
   {
      $files = glob($this->boostResourcePath('guidelines') . '/*.{md,blade.php}', GLOB_BRACE);

      $this->assertCount(1, $files, 'Boost keys third-party guidelines by package name, so only the last file would survive.');
   }

   #[Test]
   public function the_skill_carries_the_frontmatter_boost_requires(): void
   {
      foreach (['ui-patterns', 'feature-docs', 'feature-audit'] as $skill) {
         $content = (string) file_get_contents($this->boostResourcePath('skills/' . $skill . '/SKILL.md'));

         $this->assertMatchesRegularExpression('/^---\s*\nname:\s*' . preg_quote($skill, '/') . '\s*\ndescription:\s*\S/', $content);
      }
   }

   #[Test]
   public function the_guideline_renders_the_active_guidelines(): void
   {
      config()->set('tall-architect.guidelines.nontech-user', true);

      $rendered = $this->renderGuideline();

      $this->assertStringStartsWith('# TALL Architect', $rendered);
      $this->assertStringContainsString('Content of the tall-architect guideline.', $rendered);
      $this->assertStringContainsString('Content of the nontech-user guideline.', $rendered);
      $this->assertStringContainsString('Content of the feature-docs guideline.', $rendered);
   }

   #[Test]
   public function the_guideline_omits_a_disabled_guideline(): void
   {
      config()->set('tall-architect.guidelines.nontech-user', false);
      config()->set('tall-architect.guidelines.feature-docs', false);

      $this->assertStringNotContainsString('Content of the nontech-user guideline.', $this->renderGuideline());
      $this->assertStringNotContainsString('Content of the feature-docs guideline.', $this->renderGuideline());
   }

   protected function renderGuideline(): string
   {
      $path = $this->boostResourcePath('guidelines/tall-architect.blade.php');
      $placeholders = [
         '`' => '___SINGLE_BACKTICK___',
         '<?php' => '___OPEN_PHP_TAG___',
         '</x-' => '___BLADE_COMPONENT_CLOSE___',
         '<x-' => '___BLADE_COMPONENT_OPEN___',
      ];

      $content = str_replace(array_keys($placeholders), array_values($placeholders), (string) file_get_contents($path));
      $rendered = html_entity_decode((string) Blade::render($content), ENT_QUOTES | ENT_HTML5);

      return trim(str_replace(array_values($placeholders), array_keys($placeholders), $rendered));
   }
}

<?php

namespace Aaix\LaravelTallArchitect;

use Aaix\LaravelTallArchitect\Support\Guideline;
use Illuminate\Support\Collection;

class GuidelineRegistry
{
   public const TITLES = [
      'tall-architect' => 'TALL Architect',
      'planning' => 'Planning',
      'design-system' => 'Design System',
      'ux-principles' => 'UX Principles',
      'nontech-user' => 'Non-technical User Mode',
   ];

   public const DEFAULTS = [
      'tall-architect' => true,
      'planning' => true,
      'design-system' => true,
      'ux-principles' => true,
      'nontech-user' => true,
   ];

   public function sourcePath(): string
   {
      $configured = config('tall-architect.path');

      if (is_string($configured) && $configured !== '') {
         return rtrim($configured, '/\\');
      }

      return realpath(__DIR__ . '/../resources/guidelines') ?: __DIR__ . '/../resources/guidelines';
   }

   /**
    * @return Collection<string, Guideline>
    */
   public function all(): Collection
   {
      $flags = (array) config('tall-architect.guidelines', []);

      return collect(self::TITLES)->map(fn (string $title, string $key): Guideline => new Guideline(
         key: $key,
         title: $title,
         path: $this->sourcePath() . DIRECTORY_SEPARATOR . $key . '.md',
         enabled: (bool) ($flags[$key] ?? self::DEFAULTS[$key]),
      ));
   }

   /**
    * @return Collection<string, Guideline>
    */
   public function enabled(): Collection
   {
      return $this->all()->filter(fn (Guideline $guideline): bool => $guideline->enabled && !$guideline->isEmpty());
   }

   public function compose(): string
   {
      $separator = (string) config('tall-architect.separator', "\n\n---\n\n");

      return $this->enabled()
         ->map(fn (Guideline $guideline): string => $guideline->contents())
         ->implode($separator);
   }
}

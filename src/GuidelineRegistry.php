<?php

namespace Aaix\LaravelTallArchitect;

use Aaix\LaravelTallArchitect\Support\Guideline;
use Illuminate\Support\Collection;

class GuidelineRegistry
{
   public const REQUIRED = ['tall-architect', 'planning', 'design-system', 'ux-principles'];

   public const OPTIONAL = ['nontech-user'];

   public const TITLES = [
      'tall-architect' => 'TALL Architect',
      'planning' => 'Planning',
      'design-system' => 'Design System',
      'ux-principles' => 'UX Principles',
      'nontech-user' => 'Non-technical User Mode',
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
      $strict = (bool) config('tall-architect.strict', true);

      return collect(array_merge(self::REQUIRED, self::OPTIONAL))
         ->mapWithKeys(function (string $key) use ($flags, $strict): array {
            $required = in_array($key, self::REQUIRED, true);
            $enabled = (bool) ($flags[$key] ?? $required);

            return [
               $key => new Guideline(
                  key: $key,
                  title: self::TITLES[$key] ?? ucfirst($key),
                  path: $this->sourcePath() . DIRECTORY_SEPARATOR . $key . '.md',
                  required: $required,
                  enabled: $required && $strict ? true : $enabled,
               ),
            ];
         });
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

<?php

namespace Aaix\LaravelTallArchitect\Commands;

use Aaix\LaravelTallArchitect\Commands\Concerns\InteractsWithBoost;
use Aaix\LaravelTallArchitect\GuidelineRegistry;
use Aaix\LaravelTallArchitect\Support\Guideline;
use Illuminate\Console\Command;

class StatusCmd extends Command
{
   use InteractsWithBoost;

   protected $signature = 'tall-architect:status';

   protected $description = 'Show which TALL Architect guidelines are active in this project';

   public function handle(GuidelineRegistry $registry): int
   {
      $this->newLine();
      $this->components->twoColumnDetail('<fg=gray>Source</>', $registry->sourcePath());
      $this->components->twoColumnDetail('<fg=gray>Strict mode</>', config('tall-architect.strict') ? 'on' : 'off');
      $this->components->twoColumnDetail('<fg=gray>Laravel Boost</>', $this->boostStatus());
      $this->newLine();

      $rows = $registry
         ->all()
         ->map(fn (Guideline $guideline): array => [
            $guideline->title,
            $guideline->required ? 'required' : 'optional',
            $this->stateLabel($guideline),
            $guideline->exists() ? (string) $guideline->estimatedTokens() : '-',
         ])
         ->values()
         ->all();

      $this->table(['Guideline', 'Kind', 'State', '~Tokens'], $rows);

      $this->components->twoColumnDetail(
         'Reference skill',
         is_file(__DIR__ . '/../../resources/boost/skills/tall-architect/SKILL.md') ? 'shipped' : '<fg=red>missing</>',
      );
      $this->newLine();

      return self::SUCCESS;
   }

   protected function stateLabel(Guideline $guideline): string
   {
      if (!$guideline->exists()) {
         return '<fg=red>file missing</>';
      }

      if ($guideline->isEmpty()) {
         return '<fg=yellow>empty</>';
      }

      return $guideline->enabled ? '<fg=green>active</>' : '<fg=gray>disabled</>';
   }

   protected function boostStatus(): string
   {
      return match (true) {
         !$this->boostIsInstalled() => '<fg=red>not installed</>',
         !$this->boostIsConfigured() => '<fg=yellow>installed, not set up</>',
         !$this->boostKnowsThisPackage() => '<fg=yellow>set up, package not selected</>',
         default => '<fg=green>ready</>',
      };
   }
}

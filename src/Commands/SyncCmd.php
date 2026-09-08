<?php

namespace Aaix\LaravelTallArchitect\Commands;

use Aaix\LaravelTallArchitect\Commands\Concerns\InteractsWithBoost;
use Aaix\LaravelTallArchitect\GuidelineRegistry;
use Aaix\LaravelTallArchitect\Support\Guideline;
use Illuminate\Console\Command;

class SyncCmd extends Command
{
   use InteractsWithBoost;

   protected $signature = 'tall-architect:sync';

   protected $description = 'Recompose the active TALL Architect guidelines into the agent files';

   public function handle(GuidelineRegistry $registry): int
   {
      $enabled = $registry->enabled();

      if ($enabled->isEmpty()) {
         $this->components->error('No guideline is active or all of them are empty. Nothing to sync.');

         return self::FAILURE;
      }

      if ($this->refreshAgentFiles() !== self::SUCCESS) {
         return self::FAILURE;
      }

      $this->components->info('Synced ' . $enabled->count() . ' guideline(s) into the agent files.');
      $this->components->bulletList($enabled->map(fn (Guideline $guideline): string => $guideline->title)->all());

      return self::SUCCESS;
   }
}

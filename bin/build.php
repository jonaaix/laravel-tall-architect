#!/usr/bin/env php
<?php

declare(strict_types=1);

use Aaix\LaravelTallArchitect\GuidelineRegistry;

require __DIR__ . '/../vendor/autoload.php';

$sourceDir = __DIR__ . '/../resources/guidelines';
$skillsDir = __DIR__ . '/../resources/boost/skills';
$distDir = __DIR__ . '/../dist';
$separator = "\n\n---\n\n";

$variants = [
   'laravel' => [],
   'generic' => ['laravel-architect', 'building-blocks'],
];

function removeDirectory(string $path): void
{
   if (!is_dir($path)) {
      return;
   }

   $items = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
      RecursiveIteratorIterator::CHILD_FIRST,
   );

   foreach ($items as $item) {
      $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
   }

   rmdir($path);
}

function copyDirectory(string $source, string $target): void
{
   $items = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
      RecursiveIteratorIterator::SELF_FIRST,
   );

   foreach ($items as $item) {
      $destination = $target . '/' . substr($item->getPathname(), strlen($source) + 1);

      if ($item->isDir()) {
         is_dir($destination) || mkdir($destination, 0755, true);

         continue;
      }

      is_dir(dirname($destination)) || mkdir(dirname($destination), 0755, true);
      copy($item->getPathname(), $destination);
   }
}

$missing = array_filter(
   array_keys(GuidelineRegistry::TITLES),
   fn (string $key): bool => !is_file($sourceDir . '/' . $key . '.md'),
);

if ($missing !== []) {
   fwrite(STDERR, 'Missing guideline files: ' . implode(', ', $missing) . PHP_EOL);

   exit(1);
}

$skills = array_map('basename', glob($skillsDir . '/*', GLOB_ONLYDIR));

foreach ($variants as $variant => $excluded) {
   $targetDir = $distDir . '/' . $variant;

   removeDirectory($targetDir);
   mkdir($targetDir, 0755, true);

   $sections = [];

   foreach (array_keys(GuidelineRegistry::TITLES) as $key) {
      if (in_array($key, $excluded, true)) {
         continue;
      }

      $contents = trim((string) file_get_contents($sourceDir . '/' . $key . '.md'));

      if ($contents !== '') {
         $sections[] = $contents;
      }
   }

   file_put_contents($targetDir . '/CLAUDE.md', implode($separator, $sections) . "\n");

   foreach ($skills as $skill) {
      copyDirectory($skillsDir . '/' . $skill, $targetDir . '/.claude/skills/' . $skill);
   }

   fwrite(STDOUT, sprintf(
      'Wrote %s: %d guidelines, %d skills (%d bytes)%s',
      realpath($targetDir),
      count($sections),
      count($skills),
      filesize($targetDir . '/CLAUDE.md'),
      PHP_EOL,
   ));
}

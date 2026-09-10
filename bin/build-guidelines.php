#!/usr/bin/env php
<?php

declare(strict_types=1);

use Aaix\LaravelTallArchitect\GuidelineRegistry;

require __DIR__ . '/../vendor/autoload.php';

$sourceDir = __DIR__ . '/../resources/guidelines';
$targetFile = __DIR__ . '/../dist/guidelines.md';
$separator = "\n\n---\n\n";

$sections = [];
$missing = [];

foreach (array_keys(GuidelineRegistry::TITLES) as $key) {
   $path = $sourceDir . '/' . $key . '.md';

   if (!is_file($path)) {
      $missing[] = $key . '.md';

      continue;
   }

   $contents = trim((string) file_get_contents($path));

   if ($contents === '') {
      continue;
   }

   $sections[] = $contents;
}

if ($missing !== []) {
   fwrite(STDERR, 'Missing guideline files: ' . implode(', ', $missing) . PHP_EOL);

   exit(1);
}

if (!is_dir(dirname($targetFile))) {
   mkdir(dirname($targetFile), 0755, true);
}

file_put_contents($targetFile, implode($separator, $sections) . "\n");

fwrite(STDOUT, sprintf(
   'Wrote %d guidelines to %s (%d bytes)%s',
   count($sections),
   realpath($targetFile),
   filesize($targetFile),
   PHP_EOL,
));

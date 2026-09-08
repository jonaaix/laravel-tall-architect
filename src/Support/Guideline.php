<?php

namespace Aaix\LaravelTallArchitect\Support;

class Guideline
{
   public function __construct(
      public readonly string $key,
      public readonly string $title,
      public readonly string $path,
      public readonly bool $required,
      public readonly bool $enabled,
   ) {
   }

   public function exists(): bool
   {
      return is_file($this->path);
   }

   public function contents(): string
   {
      if (!$this->exists()) {
         return '';
      }

      return trim((string) file_get_contents($this->path));
   }

   public function isEmpty(): bool
   {
      return $this->contents() === '';
   }

   public function estimatedTokens(): int
   {
      return (int) round(str_word_count($this->contents()) * 1.3);
   }
}

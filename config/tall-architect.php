<?php

return [
   /*
   |--------------------------------------------------------------------------
   | Active Guidelines
   |--------------------------------------------------------------------------
   |
   | Every guideline shipped by this package is listed here. Disabling a
   | guideline removes its content from the composed agent files on the
   | next sync. Required guidelines are re-enabled unless "strict" is
   | turned off below.
   |
   */

   'guidelines' => [
      'tall-architect' => env('TALL_ARCHITECT_TALL_ARCHITECT', true),
      'planning' => env('TALL_ARCHITECT_PLANNING', true),
      'design-system' => env('TALL_ARCHITECT_DESIGN_SYSTEM', true),
      'ux-principles' => env('TALL_ARCHITECT_UX_PRINCIPLES', true),
      'nontech-user' => env('TALL_ARCHITECT_NONTECH_USER', false),
   ],

   /*
   |--------------------------------------------------------------------------
   | Strict Mode
   |--------------------------------------------------------------------------
   |
   | With strict mode enabled the required guidelines are always composed,
   | whatever the flags above say. Turn it off to allow a project to opt
   | out of a required guideline as well.
   |
   */

   'strict' => env('TALL_ARCHITECT_STRICT', true),

   /*
   |--------------------------------------------------------------------------
   | Guideline Source Directory
   |--------------------------------------------------------------------------
   |
   | Absolute path to the directory holding the guideline markdown files.
   | Leave null to use the files shipped with the package. Point it at a
   | project directory to override the whole set locally.
   |
   */

   'path' => env('TALL_ARCHITECT_PATH'),

   /*
   |--------------------------------------------------------------------------
   | Separator
   |--------------------------------------------------------------------------
   |
   | Markdown inserted between two composed guidelines.
   |
   */

   'separator' => "\n\n---\n\n",
];

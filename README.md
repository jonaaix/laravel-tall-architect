<p align="center">
  <a href="https://github.com/jonaaix/laravel-tall-architect">
    <img src="https://raw.githubusercontent.com/jonaaix/laravel-tall-architect/main/resources/laravel-tall-architect.webp" alt="Laravel TALL Architect Logo" width="200">
  </a>
</p>

<h1 align="center">Laravel TALL Architect</h1>

<p align="center">
Ships one set of AI agent rules to every project and keeps it current &mdash; composed into your agent files by <a href="https://github.com/laravel/boost">Laravel Boost</a>.
</p>

<p align="center">
  <a href="https://packagist.org/packages/aaix/laravel-tall-architect"><img src="https://img.shields.io/packagist/v/aaix/laravel-tall-architect.svg?style=flat-square" alt="Latest Version on Packagist"></a>
  <a href="https://packagist.org/packages/aaix/laravel-tall-architect"><img src="https://img.shields.io/packagist/dt/aaix/laravel-tall-architect.svg?style=flat-square" alt="Total Downloads"></a>
  <a href="https://github.com/jonaaix/laravel-tall-architect/actions/workflows/run-tests.yml"><img src="https://img.shields.io/github/actions/workflow/status/jonaaix/laravel-tall-architect/run-tests.yml?branch=main&label=tests&style=flat-square" alt="GitHub Actions"></a>
  <a href="https://github.com/jonaaix/laravel-tall-architect/blob/main/LICENSE"><img src="https://img.shields.io/packagist/l/aaix/laravel-tall-architect.svg?style=flat-square" alt="License"></a>
</p>

---

## Quick Start

```bash
composer require aaix/laravel-tall-architect --dev
php artisan boost:install
```

Boost lists third-party packages during its install &mdash; tick `aaix/laravel-tall-architect` there. In a project where
Boost is already set up, add the package to the existing selection instead:

```bash
php artisan boost:update --discover
```

That is the whole setup. The four required guidelines are now part of every agent file:

```bash
php artisan tall-architect:status
```

## What ships

Agent rules rot the moment they are copied. This package keeps them in one place and distributes them as a composer
dependency, so a correction rolls out everywhere instead of into one repository at a time.

| Content | Vehicle | Loaded |
|---|---|---|
| `tall-architect`, `planning`, `design-system`, `ux-principles` | Boost guideline | always, in every agent file |
| `nontech-user` | Boost guideline | only when enabled |
| `ui-patterns` | Boost skill `ui-patterns` | on demand, when the agent asks for it |

The guideline markdown lives in `resources/guidelines/`, the reference in
`resources/boost/skills/ui-patterns/ui-patterns.md`.

## Enabling the optional guideline

Set the env variable, or publish the config and edit it there:

```dotenv
TALL_ARCHITECT_NONTECH_USER=true
```

```bash
php artisan vendor:publish --tag=tall-architect-config
```

Then recompose the agent files:

```bash
php artisan boost:update
```

With `strict` enabled (the default) a required guideline stays active whatever its flag says. Set
`TALL_ARCHITECT_STRICT=false` if a project genuinely needs to opt out of one.

## Commands

| Command | Purpose |
|---|---|
| `tall-architect:status` | Source path, Boost state, and every guideline with its state and token cost |
| `tall-architect:sync` | `boost:update` with a guard: refuses when nothing is active, reports what got composed |

## Keeping projects current

```bash
composer update aaix/laravel-tall-architect
php artisan boost:update
```

## Developing the guidelines

To iterate on the rules without a `composer update` per change, wire the package into a project as a path repository.
Composer symlinks it, so edits land in `vendor/` immediately:

```bash
composer config repositories.tall-architect path ../laravel-tall-architect
composer require aaix/laravel-tall-architect:@dev --dev
```

The loop is then: edit a file under `resources/guidelines/`, run `php artisan boost:update`. The update stays necessary
because Boost writes the agent files statically, but it costs a second.

For guideline-only changes the symlink can be skipped entirely &mdash; point the source path at your working copy:

```dotenv
TALL_ARCHITECT_PATH=/absolute/path/to/laravel-tall-architect/resources/guidelines
```

That covers the guidelines only. The `ui-patterns` skill is copied out of `vendor/` by Boost itself, so changing it needs
the symlink.

Undo before switching back to a released version:

```bash
composer config --unset repositories.tall-architect
```

## Overriding the guidelines locally

A project can replace the whole set with its own. Publish the shipped files as a starting point:

```bash
php artisan vendor:publish --tag=tall-architect-guidelines
```

They land in `.ai/tall-architect/`. Point `TALL_ARCHITECT_PATH` at that directory to use them instead of the packaged
ones.

## Why one guideline file

Boost keys third-party guidelines by composer package name, so a package that ships several markdown files into
`resources/boost/guidelines/` only ever gets one of them composed &mdash; the rest are dropped silently. This package
therefore ships a single Blade guideline that assembles the selected markdown files at render time. A test enforces the
one-file rule.

## Testing

```bash
composer test
```

## License

[MIT](LICENSE)

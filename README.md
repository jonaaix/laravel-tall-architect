<p align="center">
  <a href="https://github.com/jonaaix/laravel-tall-architect">
    <img src="https://raw.githubusercontent.com/jonaaix/laravel-tall-architect/main/icon.svg" alt="Laravel TALL Architect Logo" width="220">
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

Boost lists third-party packages during its install &mdash; tick `aaix/laravel-tall-architect` there. Where Boost is
already set up, add the package to the existing selection instead:

```bash
php artisan boost:update --discover
```

That is the whole setup. All five guidelines are now part of every agent file; `php artisan tall-architect:status` shows
the result.

## What ships

| Content | Vehicle | Loaded |
|---|---|---|
| `tall-architect`, `planning`, `design-system`, `ux-principles`, `nontech-user` | Boost guideline | always, in every agent file |
| `ui-patterns` | Boost skill `ui-patterns` | on demand, when the agent asks for it |

Agent rules rot the moment they are copied. Here they stay a composer dependency, so a correction rolls out everywhere
instead of into one repository at a time.

## Choosing the guidelines

All five are on by default, and each has its own flag:

```dotenv
TALL_ARCHITECT_NONTECH_USER=false
```

Run `php artisan boost:update` afterwards to recompose the agent files.

To replace the shipped set with a project's own, publish it with `php artisan vendor:publish --tag=tall-architect-guidelines`
and point `TALL_ARCHITECT_PATH` at the resulting directory.

## Keeping projects current

```bash
composer update aaix/laravel-tall-architect
php artisan boost:update
```

## Commands

| Command | Purpose |
|---|---|
| `tall-architect:status` | Boost state and every guideline with its state and token cost |
| `tall-architect:sync` | `boost:update` with a guard: refuses when nothing is active, reports what got composed |

## License

[MIT](LICENSE)

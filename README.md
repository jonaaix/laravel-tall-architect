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

That is the whole setup. All seven guidelines are now part of every agent file; `php artisan tall-architect:status` shows
the result.

## What ships

| Content | Vehicle | Loaded |
|---|---|---|
| `engineering`, `tall-architect`, `planning`, `feature-book`, `design-system`, `ux-principles`, `nontech-user` | Boost guideline | always, in every agent file |
| `ui-patterns` | Boost skill `ui-patterns` | on demand, when the agent asks for it |
| Feature Book chapters | Boost skill `feature-book` | when creating or substantially revising a chapter |
| Comprehensive implementation review | Boost skill `feature-book-audit` | only on explicit user request |

Agent rules rot the moment they are copied. Here they stay a composer dependency, so a correction rolls out everywhere
instead of into one repository at a time.

## Choosing the guidelines

All seven are on by default, and each has its own flag:

```dotenv
TALL_ARCHITECT_NONTECH_USER=false
TALL_ARCHITECT_FEATURE_BOOK=false
```

Run `php artisan boost:update` afterwards to recompose the agent files. The flags control the always-on text;
they do not remove the separately shipped skills.

To replace the shipped set with a project's own, point `TALL_ARCHITECT_PATH` at a directory holding files of the same names.

## Feature Book and audits

The Feature Book preserves agreed user intent independently of the implementation, one chapter per feature. Chapters live at
`.ai/project/features/<domain>/<feature>.md`, grouped by business capability, with stable feature
IDs, an immutable creation date, and inline YAML tags such as `tags: [billing, payments]`. Every chapter
uses three plain-language sections: What is it for?, How does it work?, and Examples. Feature-specific
subheadings are welcome; rule IDs and code maps are not required. Technical implementation choices remain
open unless explicitly required or necessary for the agreed behavior. Relevant technical details remain part
of the chapter.
A compact `index.md` provides navigation. Plans track unfinished work;
the Feature Book states the agreed behavior.

The `feature-book` guideline tells agents to write chapters as part of the work, without offering or asking, to read relevant chapters before making changes and update
affected passages with authorized behavior changes. Refactors do not require rewriting the specification.
Code observations alone never establish requirements. Agents may suggest an audit after substantial changes
or discovered contradictions; elapsed time alone does not trigger a reminder or an automatic audit.

Example requests:

- “Use feature-book to write the booking cancellation chapter from our agreed requirements. Clarify behavior inferred
  only from code before including it.”
- “Use feature-book-audit to comprehensively check billing against its chapters.”
- “Use feature-book-audit to review the whole Feature Book for up to two hours and save progress for resuming.”

Audits write coverage, evidence, findings, and continuation state to
`.ai/project/audits/<YYYY-MM-DD>_<scope>_<unique-run-id>/report.md`. They distinguish static inspection from
executed tests, extract checks from the chapters without imposing technical choices, preserve unresolved
and pending checks, and do not repair code or rewrite requirements.
Long runs can resume after checking for changed inputs. Time/token limits depend on available measurement;
the skill cannot determine remaining account quota or provide background scheduling itself.

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

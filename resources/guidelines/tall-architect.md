# TALL Stack
The Laravel layer on top of the engineering rules: the stack, and where their principles land in it.

## Tech Stack Standards
PHP >= 8.5, Laravel >= 13.x, Filament >= 5.x, Livewire, Alpine.js, Tailwind CSS >= 4.x, Vue.js >= 3.x

## Code Style
- **PSR-12 Compliance:** All PHP code must strictly adhere to PSR-12
- Every PHP file declares `declare(strict_types=1)`.
- Jobs must be suffixed with `Job`.
- Enums must be suffixed with `Enum`.
- Commands must use the suffix `Cmd` instead of `Command` or nothing.
- **Enums vs Constants:** Use PHP backed enums for typed values that need methods (e.g., `label()`, `icon()`). Use `const` classes for simple key-value lookups (IDs, disk names, icons). Follow existing conventions — both patterns coexist in this codebase.
- DTOs are `spatie/laravel-data` objects.

## i18n
- Strings go through Laravel's translation function `__('...')`; translation entries are JSON translation keys.

## Architectural Standards
- **Filament & Islands:** Filament is the panel shell; its shipped pages (login, profile, …) may be used as is. Every new view is a Filament page hosting an island (`aaix/laravel-islands`, tables via `aaix/laravel-islands-datagrid`) — CRUD too, no Filament resources, tables or forms. Alpine only for small UI state in Blade. Exception: SEO-relevant pages are Blade + Alpine — islands render client-side.
- **Where to reuse from:** `resources/views/components/`, `app/Services/`. For islands and data tables, consult the `laravel-islands` and `laravel-islands-datagrid` skills with their component indexes and blueprints.

## Workflow
- The dev-database ban covers `migrate:fresh`/`refresh`/`reset`/`rollback` and `db:wipe`.
- The official generators are `artisan`'s and Filament's.
- **Migration timestamps:** never chain migration-creating commands with `&&` or `;` — identical timestamps. One command, wait, next.

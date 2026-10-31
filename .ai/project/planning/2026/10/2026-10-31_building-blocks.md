# Goal

One place that tells agents which package serves which need, so they neither build their own nor pick an alternative. Done when `building-blocks` ships and `laravel-architect` no longer holds need-to-package mappings.

# Milestones

- [x] Add `building-blocks` with config flag, README, tests and the Laravel-only build variant.
- [x] Move the mappings out of `laravel-architect`: Filament as panel shell, the islands packages, `spatie/laravel-data`.
- [x] Settle the `format.js` rule with the islands agent; its line left `laravel-architect`.

# State

`building-blocks` sits after `laravel-architect`, on by default, only in `dist/laravel/`. `laravel-architect` keeps the view structure rules. Released in 1.6.0.

# Decisions

- Keyed by need, not by package: an agent starts from what it has to build. A need may map to a third-party package.
- Binding even when the package isn't installed: the agent proposes installing it rather than building or substituting.
- How to use a package stays in the package's own Boost skills. The islands skills already cover modals (`Modal`, `FormModal`) and the datagrid toolbar icons, so those hints left this package.
- The `format.js` rule now lives in the laravel-islands guide, where `@Shared` is defined.

# Open

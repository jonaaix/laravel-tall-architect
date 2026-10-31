# Goal

One command builds ready-to-copy agent files with every guideline enabled, in two variants: Laravel projects and any other project. Done when `composer build` writes both variants to `dist/`.

# Milestones

- [x] Move the islands and Filament passages out of `design-system` into the Laravel layer.
- [x] Rename the `tall-architect` guideline to `laravel-architect`.
- [x] Replace `build-guidelines` with `composer build` writing `dist/laravel/` and `dist/generic/`.

# State

`composer build` writes `dist/laravel/` (all guidelines) and `dist/generic/` (all but `laravel-architect`), each a `CLAUDE.md` plus every skill under `.claude/skills/`. `dist/` stays git-ignored.

# Decisions

- `design-system` belongs to both variants: apart from three islands/Filament passages it only assumes Tailwind. Those passages moved to the Laravel layer.
- The Laravel layer is named `laravel-architect`, the user's choice over `laravel-stack`. No project uses its env flag or a published config, so the rename breaks nothing.

- Skills ship with both variants so guideline references to them resolve once copied; none of them depends on Laravel.
- The build also rewrites this repo's `AGENTS.md` as a plain copy of the Laravel variant, so the repo's agents follow the current rules.
- One command for both variants, replacing `build-guidelines`, so two near-identical builds don't drift.

# Open

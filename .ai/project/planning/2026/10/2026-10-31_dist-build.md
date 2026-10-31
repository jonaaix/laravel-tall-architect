# Goal

One command builds ready-to-copy agent files with every guideline enabled, in two variants: Laravel projects and any other project. Done when `composer build` writes both variants to `dist/`.

# Milestones

- [x] Move the islands and Filament passages out of `design-system` into the Laravel layer.
- [ ] Rename the `tall-architect` guideline to `laravel-architect`.
- [ ] Replace `build-guidelines` with `composer build` writing `dist/laravel/` and `dist/generic/`.

# State

`design-system` is platform agnostic; its islands and Filament passages live in the Laravel layer.

# Decisions

- `design-system` belongs to both variants: apart from three islands/Filament passages it only assumes Tailwind. Those passages moved to the Laravel layer.
- The Laravel layer is named `laravel-architect`, the user's choice over `laravel-stack`. No project uses its env flag or a published config, so the rename breaks nothing.

# Open

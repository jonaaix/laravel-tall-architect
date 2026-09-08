# Design System

This project's visual decisions. Principles live in the UX Principles rules below, concrete
class recipes in the `ui-patterns` skill — read it before building UI.

## Visual language

We adapt shadcn/ui by hand in Tailwind — the package is not installed.

- **Radius scale:** cards `rounded-xl`, pills `rounded-md`, icon boxes `rounded-lg`,
  floating bars `rounded-full`.
- **Flat rings, no shadows on cards.** Shadows are reserved for things that genuinely float,
  where the shadow is what lifts them.
- **Padding `p-3`–`p-5`.** Wasteful padding looks dated.
- **Dark mode is native.** Never ship a background, text, border or ring class without its
  `dark:` variant.

## Wording

Page titles are Title Case, everything else sentence case — buttons, labels, tabs,
columns, menu items.

## Colour

- **Derive, don't hardcode.** Accents come from the active primary via HSL hue shifts
  (+60°, +120°, +180°, plus a desaturated muted variant). Hex values only as sentinels the
  theme layer replaces.
- **Neutrals for the chrome.** Text, borders and disabled states stay true gray.

## Icons

- **Heroicons only.** Outline 24 is the default. Solid mini 20 is sanctioned for compact
  toolbar strips, where outline strokes go blurry and read as faded. Pick a lane per strip
  and stay in it — never mix within one strip.
- **Every icon is its own component** with a stable name and fixed viewBox. Never inline
  `<svg>` in a consumer; that forks the visual set between callsites.
- The datagrid ships its own toolbar icons from `@aaix/laravel-islands-datagrid/vue` —
  islands import them rather than redrawing.
- **Icon boxes only beside a heading or a stat value.** In tabs, buttons, cells and hover
  affordances icons ship bare.

## Controls

**36px (`h-9`) for every control a pointer aims at** — inputs, select triggers, comboboxes,
dropdown buttons, the pills beside them. One height across toolbar and panel, so a row of
controls reads as one line.

Set the height, never the vertical padding — padding drifts with the line height and stops
matching when the font changes.

Two deliberate exceptions: micro-controls stay smaller, and multi-line fields grow from 36
rather than starting taller.

## Stacking order

One ladder for the whole app, so a new layer never lands under an old one. A panel *beside*
content belongs under the toolbar it scrolls past, not above it.

| Layer | z |
| --- | --- |
| Panels beside content | 10 |
| Table toolbar, floating bars | 20 |
| Application chrome (topbar, sidebar) | 30 |
| Dropdown backdrop / menu | 60 / 61 |
| Modal | 70 |
| Tooltip | 9999 |

## Motion

| What | Duration | Curve |
| --- | --- | --- |
| Panel unfolding | 350ms | `cubic-bezier(0.22, 1, 0.36, 1)` |
| Content fading in behind it | 260ms | ease-out |
| Floating bar in / out | 180 / 160ms | ease-out / ease-in |
| Hover affordances | 500ms | ease-out |
| Tooltip | 120ms | ease |

## Tables

- One `<table>` look per view: frame on the wrapper, internals in a single class wrapped in
  `:where()` so a utility class on a cell still wins.
- **Seven page numbers.**

## Formatting

Numbers, dates, money and weights go through `@shared/format.js` — `formatCurrency`,
`formatDate`, `formatRelative`, `formatWeight`. Figures use `tabular-nums`.
Times display in the user's timezone, 24-hour format — never the server's.

## Charts (ApexCharts)

Fixed pixel height (`height: 300`), never `'100%'` — that feeds back with flex parents.
Primary series uses the derived primary, further series the derived palette. Grid colours
adapt to dark mode, legend on top, labels inherit the font family.

## Alerts

Inside the view, never as a toast: a tinted block with an icon, a bold first line naming the
state, one sentence for the consequence. It sits next to what it talks about. Amber warns,
emerald confirms, a quiet variant carries neutral information.

## Modals

Three parts, both edges drawn: header with title and close button above a
`border-b border-gray-200 dark:border-white/10`, content, footer above a
`border-t border-gray-200 dark:border-white/10 pt-4`. Cancel (`tone="secondary"`) left of
the primary action (`tone="cta"`), both at default size — never `size="sm"` in a modal
footer. Laravel Islands and Filament both ship modal helpers — use them rather than
rebuilding this by hand.

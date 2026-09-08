# UX Principles

Portable rules for admin panels and ERPs. No framework, no project specifics.
Rules of thumb — deviate knowingly, not by accident.

## State & feedback

- **Three states, always.** Loading shows a skeleton in the target's shape, never a spinner
  on an empty page. Errors say what failed and offer retry. Empty says why, and offers to
  clear the filter that caused it.
- **Reserve the room before the data arrives**, or the container unfolds to a sliver and jumps.
- **What the user just did stays on screen** until the server echoes it back.
- **Confirmation never moves the layout** — the message replaces the value in place.

## Data display

- **Never truncate a value in a table.** Let the region scroll; a clipped part number is
  worse than a scrollbar. Ellipsis is for prose.
- **Fixed-width figures**, so columns don't jitter as numbers change.
- **Format centrally** — never by hand, never with a hardcoded locale.
- **Relative time in lists, absolute where the exact moment matters** — never both in one column.
- **Density beats spacing in data-dense views.** More per screen wins over generous padding.

## Colour & status

- **Status overrides theme.** Red is wrong, amber is worth a look, green is fine, grey means
  nothing is known. A green brand colour must never break "wrong is red".
- **Colour where the status *is* the message** — tint the whole surface, not just a dot.
  **Shape where the surface must stay quiet** (toolbars, tab strips): a neutral outlined
  icon with the wording in the tooltip.
- **One verdict, one source.** The same helper decides colour, sentence and icon.

## Actions

- **Every number is a door.** If a value summarises something, clicking it leads there.
- **Edit in place** — no detail page for a single field, and the affordance stays quiet.
  Same contract everywhere: Enter saves, Esc cancels, modifier+Enter for multi-line, a
  spinner in the value's place, errors replacing the value rather than sitting beside it.
- **Confirm what cannot be undone, and only that.** Cancel, Escape and a click outside all
  mean no.
- **The whole control is the target**, not the words in it.
- **Two tiers of action:** attention-worthy gets a tint, repeat actions stay neutral,
  saturated brand colour is for one-off CTAs. Micro-controls stay small enough not to
  compete with content.
- **Dropdowns over button rows** beyond three options.
- **One thing open per row.** Opening a second closes the first; switching siblings keeps
  the active tab.
- **Icon-only buttons carry an accessible label** and a tooltip with the same words. Never
  a native `title` tooltip.
- **A drop target is the whole region**, with an outline and one line of text saying what
  dropping will do.
- **Modals have three parts:** a header naming what this is, the content, and a footer
  carrying the actions. Actions never hang off the last field.
- **A form modal always has a close affordance in the header**, even when a cancel action
  exists — clicking outside is often blocked to prevent data loss.

## Motion

Movement explains a change; it never announces itself.

- **What appears must also disappear.** An animated entrance with an abrupt exit reads as
  a glitch.
- **Rows have no height to animate.** Grow a shell inside them instead.

## Navigation & persistence

- **Deep-link the view, not the page.** Expanded row, active tab, filters, page and sort
  belong in the URL.
- **View choices are remembered per user, not per browser.** Cache locally, but the server
  owns the value.
- **Give the scroll position back.** Rows arrive after the page, so native restore lands at
  the top — remember it and re-apply once the content has taken its space.
- **Prefetch on intent.** Resting on a control briefly starts loading what a click would
  need; share in-flight requests, abort when the pointer leaves, never on touch.

## Layout

- **Auto-fit over fixed grids.** Don't hardcode column counts unless content demands it.
  Equal heights within a row.
- **Keep the page's natural scroll.** Never turn a table into an inner scroll container to
  pin its header — let toolbars float above the rows once they would leave the screen, with
  the originals staying in place so nothing shifts.
- **Sliding pagination window.** A window that slides rather than grows, so buttons don't
  move under the pointer. Arrows keep their distance from the numbers.
- **Filters beside the table** where the viewport allows, floating over it when not — never
  above the table's own toolbar.

## Components & wording

- **Two call sites is a coincidence, three is a component.** Search before building; a
  near-duplicate is worse than a long file.
- **Wording never goes into a shared component.** It takes labels as props — the
  application owns the strings.
- **Every string goes through the translation layer**, English as the key.
- **UI text names things, it doesn't explain them.** Labels are terms, not phrases —
  "Slowest", not "Takes the longest". All UI text is product copy: if it wouldn't pass
  in a professional SaaS interface, rewrite it.
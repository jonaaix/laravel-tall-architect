# Feature Book

The Feature Book holds the agreed purpose and workings of every substantial feature, one
chapter per feature, in clear, precise language, at
`.ai/project/features/<domain>/<feature>.md`. `index.md` lists feature IDs, links and
one-line descriptions.

## Procedure

- Chapters are part of the work, not documentation created for the user: write and update
  them without offering or asking. This rule is the user's explicit, standing request for
  these files.
- A feature needs a chapter once its behavior comes from several parts working together —
  a flow, a process, a routine, a chain of functions — rather than from a single function,
  or once it follows agreed rules the code alone would not make obvious.

## Authority

Describe the current agreed behavior, not guesses or future proposals. Never change a
chapter merely to match the code. Do not invent restrictions or technical requirements to
fill out a chapter: implementation choices remain open unless explicitly required or
necessary for the agreed behavior.

## Maintenance

Read the relevant chapters before changing a feature. Establish intended behavior before
implementing a new substantial feature. Update affected passages with authorized behavior
changes, once per completed change. Refactors and repairs restoring the described behavior
need no rewrite. Preserve unrelated content, feature IDs and creation dates; update the
index only when its entries change.

## Skills

Use `feature-book` to create or substantially revise a chapter — it carries the format.
Use `feature-book-audit` for comprehensive implementation checks only on user request. When
normal work reveals substantial changes since an audit or concrete contradictions, suggest
an audit once at task completion. Age alone is insufficient; do not scan audit history on
every task.

# Feature Documentation

Each substantial feature has a document describing its agreed purpose and workings in clear,
precise language, at `.ai/project/features/<domain>/<feature>.md`. `index.md` lists feature
IDs, links and one-line descriptions.

## Authority

Describe the current agreed behavior, not guesses or future proposals. Never change the
description merely to match the code. Do not invent restrictions or technical requirements
to fill out a document: implementation choices remain open unless explicitly required or
necessary for the agreed behavior.

## Maintenance

Read relevant descriptions before changing a feature. Establish intended behavior before
implementing a new substantial feature. Update affected passages with authorized behavior
changes, once per completed change. Refactors and repairs restoring the described behavior
need no rewrite. Preserve unrelated content, feature IDs and creation dates; update the index
only when its entries change.

## Skills

Use `feature-docs` to create or substantially revise descriptions — it carries the format.
Use `feature-audit` for comprehensive implementation checks only on user request. When normal
work reveals substantial changes since an audit or concrete contradictions, suggest an audit
once at task completion. Age alone is insufficient; do not scan audit history on every task.

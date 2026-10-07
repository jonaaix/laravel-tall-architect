# Goal

Ship the Feature Book — readable chapters of agreed feature behavior — and an explicit comprehensive audit workflow, with all project-owned artifacts under `.ai/project/`.

# Milestones

- [done] Inspect existing guidelines, skill packaging, registry, and tests.
- [done] Agree the hybrid maintenance workflow and separate V1 audit skill.
- [done] Implement the feature-book guideline and feature-book and feature-book-audit skills.
- [done] Register the guideline, expose all skills in status, and document usage and breaking migration.
- [done] Move this plan and update planning and published-guideline paths to `.ai/project/`.
- [done] Build distribution, validate skills, and run the package suite and diff checks.

- [done] Adopt three plain-language chapters, remove required rule IDs and code maps, and adapt audit coverage.

# State

Released in 1.4.0, renamed to Feature Book in 1.4.1. Seven guidelines are composed; both skills use the existing Boost resource layout. The Feature Book is enabled by default and configurable through `TALL_ARCHITECT_FEATURE_BOOK`, with `TALL_ARCHITECT_FEATURE_DOCS` read as fallback.

Validation passed: `composer build-guidelines`; `composer test` (16 tests, 44 assertions); skill-creator quick validation for both skills; `git diff --check`. Distribution was regenerated locally (the dist directory is git-ignored). Skill validation checks structure, not real-world agent execution; no overnight audit was run.

The plain-language revision passed distribution build, both skill validators, and diff checks. PHP code was unchanged in this revision; the prior package test result still applies.

Existing user changes to AGENTS.md and CLAUDE.md were not modified. Changes are available in the working tree for review.

# Decisions

- Chapters preserve confirmed user intent independently of code. Unconfirmed observations and unresolved questions never silently become requirements.
- Chapters require three plain-language sections: What is it for?, How does it work?, and Examples. Feature-specific subheadings are allowed. Open questions and unconfirmed observations stay outside the Feature Book; no rule IDs or code maps are required. Business tags use a comma-separated inline YAML list and reuse existing terms; explicit links describe dependencies. The guideline omits planning and audit procedure details.
- Chapters live at `.ai/project/features/<domain>/<feature>.md`, with immutable creation dates and stable feature IDs. A compact index provides navigation.
- Routine work updates only affected rules for authorized behavior changes. Refactors and repairs restoring intended behavior do not require specification rewrites.
- The feature-book skill supports initial chapters and substantial revisions. The explicitly requested feature-book-audit skill performs comprehensive comparison of statements extracted from chapters with persistent reports, evidence, coverage, and resume checkpoints.
- Audit reports live at `.ai/project/audits/<date>_<scope>_<unique-run-id>/report.md`. Audits do not authorize repairs or requirement changes. Interrupted and unverifiable coverage remains explicit.
- Audit reminders are tied to substantial changes or discovered contradictions during normal work. Age alone never triggers a reminder; agents do not scan audit history on every task.
- Project-owned planning, app guidelines, Feature Book chapters, audit reports, and published package guideline overrides use `.ai/project/`. The breaking change requires manual migration; no compatibility fallback is provided. Package resources retain their existing source locations.
- No scheduler, quota detection, automatic audit, or guaranteed background execution is introduced.
- Named Feature Book with chapters, not documentation: Boost only allows documentation files on explicit request, so agents never created them. The guideline states chapters are part of the work and the user's standing request, like the planning file.

- Technical choices left open by the chapter are implementation freedom, not audit deviations. Audit-only check IDs and source references preserve coverage without adding formal requirements to the chapter.

- Clear language does not exclude technical detail. Preserve explicit technical requirements and details needed to explain the feature; audits assess these alongside intended outcomes.

# Open

None. Implementation is ready for user review.

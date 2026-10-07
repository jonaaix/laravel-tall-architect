# Goal

Ship readable feature behavior documentation and an explicit comprehensive audit workflow, with all project-owned artifacts under `.ai/project/`.

# Milestones

- [done] Inspect existing guidelines, skill packaging, registry, and tests.
- [done] Agree the hybrid maintenance workflow and separate V1 audit skill.
- [done] Implement the feature-docs guideline and feature-docs and feature-audit skills.
- [done] Register the guideline, expose all skills in status, and document usage and breaking migration.
- [done] Move this plan and update planning and published-guideline paths to `.ai/project/`.
- [done] Build distribution, validate skills, and run the package suite and diff checks.

- [done] Adopt three plain-language chapters, remove required rule IDs and code maps, and adapt audit coverage.

# State

Implemented on `feature/feature-docs`. Seven guidelines are composed; both new skills use the existing Boost resource layout. Feature documentation is enabled by default and configurable through `TALL_ARCHITECT_FEATURE_DOCS`.

Validation passed: `composer build-guidelines`; `composer test` (16 tests, 44 assertions); skill-creator quick validation for both skills; `git diff --check`. Distribution was regenerated locally (the dist directory is git-ignored). Skill validation checks structure, not real-world agent execution; no overnight audit was run.

The plain-language revision passed distribution build, both skill validators, and diff checks. PHP code was unchanged in this revision; the prior package test result still applies.

Existing user changes to AGENTS.md and CLAUDE.md were not modified. Changes are available in the working tree for review.

# Decisions

- Feature documents preserve confirmed user intent independently of code. Unconfirmed observations and unresolved questions never silently become requirements.
- Documents require three plain-language chapters: What is it for?, How does it work?, and Examples. Feature-specific subheadings are allowed. Open questions and unconfirmed observations stay outside feature descriptions; no rule IDs or code maps are required. Business tags use a comma-separated inline YAML list and reuse existing terms; explicit links describe dependencies. The guideline omits planning and audit procedure details.
- Stable documents live at `.ai/project/features/<domain>/<feature>.md`, with immutable creation dates and stable feature IDs. A compact index provides navigation.
- Routine work updates only affected rules for authorized behavior changes. Refactors and repairs restoring intended behavior do not require specification rewrites.
- The feature-docs skill supports initial documentation and substantial revisions. The explicitly requested feature-audit skill performs comprehensive comparison of statements extracted from natural-language descriptions with persistent reports, evidence, coverage, and resume checkpoints.
- Audit reports live at `.ai/project/audits/<date>_<scope>_<unique-run-id>/report.md`. Audits do not authorize repairs or requirement changes. Interrupted and unverifiable coverage remains explicit.
- Audit reminders are tied to substantial changes or discovered contradictions during normal work. Age alone never triggers a reminder; agents do not scan audit history on every task.
- Project-owned planning, app guidelines, feature descriptions, audit reports, and published package guideline overrides use `.ai/project/`. The breaking change requires manual migration; no compatibility fallback is provided. Package resources retain their existing source locations.
- No scheduler, quota detection, automatic audit, or guaranteed background execution is introduced.

- Technical choices left open by the description are implementation freedom, not audit deviations. Audit-only check IDs and source references preserve coverage without adding formal requirements to the feature document.

- Clear language does not exclude technical detail. Preserve explicit technical requirements and details needed to explain the feature; audits assess these alongside intended outcomes.

# Open

None. Implementation is ready for user review.

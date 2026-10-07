---
name: feature-docs
description: Create or substantially revise clear descriptions of a feature's agreed purpose and workings, including relevant technical requirements. Use for feature documentation work; comprehensive implementation audits use feature-audit.
---

# Feature Documents

Write descriptions that let the user say: "Yes, that is how it should work."
Use plain English for project artifacts and the user's language for discussion. A documentation request
permits document changes, not code changes. Keep discussion-only proposals in the planning file.

## Establish the Intended Behavior

Read `.ai/project/features/index.md` if present, then relevant descriptions, decisions, and code entry points.
Reuse existing coverage. Code can reveal current behavior but cannot establish what the user wants.
Clarify consequential uncertainty before presenting it as agreed behavior. Keep questions and proposals in
planning and audit observations in reports, outside feature descriptions. If intent is unavailable, ask for
it rather than publishing an unconfirmed feature document. Preserve already agreed passages while clarifying
an uncertain change. Do not ask the user to decide technical details that leave the desired behavior unchanged.

## Write the Description

Use `.ai/project/features/<domain>/<feature>.md`, one document per coherent feature. Add subdomains only
when helpful; never date paths. Show the target tree before creating or moving files.

Use these three chapter names in this order after the title. The prompts below explain what to write;
replace them with the actual description:

```markdown
---
id: booking-cancellation
created: 2026-10-07
tags: [booking, cancellation]
---

# Cancelling a booking

## What is it for?
Explain what this feature helps someone achieve and why it exists.

## How does it work?
Describe what happens, what someone can do, and the conditions and special cases that matter.
Use subheadings drawn from the feature itself when helpful.

## Examples
Illustrate the agreed behavior through concrete situations and their outcomes.
```

Write connected, familiar language. Features can be interactive or automatic; do not force them into a
particular actor, screen, or step-by-step workflow. Include permissions, limits, or failure behavior only
where relevant to understanding the agreed outcome. Avoid prescribed technical categories, formal rule
numbering, and compulsory code maps. Examples clarify existing intent; they must not introduce new policy.
Do not invent content to fill a chapter. If missing information prevents a useful description, clarify it.

Leave technical implementation choices open unless they are explicitly required or necessary for the desired
behavior. Describe the visible or meaningful result rather than prescribing classes, tables, or algorithms.
Link related descriptions where their behavior matters instead of repeating them.

## Metadata and Maintenance

Keep the unique feature ID stable through moves and renames. Set `created` to the actual creation date once.
Use relevant lowercase, kebab-case tags that help discover the feature and connect related topics.
Reuse existing tags where appropriate; avoid redundant or overly generic terms. Use a comma-separated YAML list
such as `tags: [booking, cancellation]`, not a string. Avoid framework names and temporary review statuses.
Tags aid discovery; direct links explain specific relationships.

Update only passages affected by authorized decisions. Never rewrite desired behavior just to match a defect.
Maintain the index as a compact table of feature ID, relative link, and one-line description; update links
when moving documents. Do not add audit status or duplicate the description in the index.

Check the three chapters, metadata, links, and consistency with agreed intent. Read the result as a user:
is the feature understandable, and are relevant technical requirements preserved accurately? Report unresolved decisions
separately. Documentation alone does not prove that the implementation conforms to it.

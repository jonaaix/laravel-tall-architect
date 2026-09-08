# Planning

Multi-step work is tracked in a file under `.ai/planning/`, so any developer or agent can
take over from a cold start.

## Procedure

- Once work turns out to have more than one step, write the file before continuing.
  One file per feature, named after it (`form-modal-shell.md`).
- Update it as the work moves: state, milestones, decisions. Overwrite, don't append —
  the file describes how things *are*, not what happened. The history is in the git log.
- Commit it with the code it belongs to, not separately.
- When the feature is merged, move the file to `.ai/planning/archive/`.
- When starting work in an area, check the archive for an earlier file on the same subject.

## File structure

- **Goal** — what this feature does, and how you can tell it's finished.
- **Milestones** — the steps to get there, in order, each marked open or done.
- **State** — where the work stands right now: what exists in the code, what is still missing.
- **Decisions** — what was settled and why, including what was rejected. Only what explains
  the current state; not the back and forth that led to it.
- **Open** — what still needs a decision from the user.

Keep it short enough to stay accurate. A file nobody trusts is worse than no file.
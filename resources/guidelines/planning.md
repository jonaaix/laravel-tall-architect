# Planning

Multi-step work is tracked in a file under `.ai/planning/`, so any developer or agent can
take over from a cold start.

## Procedure

- Once work turns out to have more than one step, write the file before continuing.
- **Write it straight to its final location:** `.ai/planning/<year>/<month>/<feature>.md`,
  dated by when the work starts. Nothing is moved or archived later.
- Update it as the work moves: state, milestones, decisions. Overwrite, don't append —
  the file describes how things *are*, not what happened. The history is in the git log.
- Commit it with the code it belongs to, not separately.
- To pick up unfinished work, look at the current and previous month folder for files with
  open milestones. When starting work in an area that has been touched before, look for its
  earlier file.

## File structure

- **Goal** — what this feature does, and how you can tell it's finished.
- **Milestones** — the steps to get there, in order, each marked open or done.
- **State** — where the work stands right now: what exists in the code, what is still missing.
- **Decisions** — what was settled and why, including what was rejected. Only what explains
  the current state; not the back and forth that led to it.
- **Open** — what still needs a decision from the user.

These sections are the whole file. No others — a proposal is a decision not yet taken, a todo
is an open milestone. If a milestone needs a plan of its own, it is its own feature file.

## Keeping it readable

- **Data doesn't go in the planning file.** Mapping tables, generated trees, exported lists:
  if they are needed to reproduce the change, they belong in the migration or patch that
  applies them. If they are working material, leave them out — the file says what the data
  is and where it lives, not what it contains.
- **Soft limit ~200 lines.** Past that, ask what is in there that is neither goal, state nor
  decision.
- A decision stays as long as it would still surprise someone reading the code. Once the code
  makes it obvious, drop the entry.

Decisions that reach beyond this feature — a deprecated subsystem, a convention for the whole
app — go into `.ai/guidelines/app.md`, not here; one line here pointing at them is enough.

When you add to `app.md`, fit the entry into the existing structure: put it in the section it
belongs to, merge it with a rule that already covers the same ground, and replace a rule the
new decision supersedes. Never append at the end. Restructure freely, but never change what a
rule says while doing it.

Keep it short enough to stay accurate. A file nobody trusts is worse than no file.

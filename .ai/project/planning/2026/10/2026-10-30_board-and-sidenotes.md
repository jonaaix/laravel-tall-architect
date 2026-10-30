# Goal

Two always-on guidelines: a shared board for agents working in parallel in one checkout, and sidenotes that keep what the user mentions in chat when it has no other home. Done when both ship as toggleable guidelines and the unused sync command is gone.

# Milestones

- [x] Agree board format, location and lifecycle.
- [x] Agree sidenotes scope, name and cleanup rule.
- [x] Add both guidelines with config flags, README and tests.
- [x] Remove `tall-architect:sync`.
- [x] User reviews the result before push.
- [ ] Observe how sidenotes grow in real projects; decide whether they need a limit.

# State

Both guidelines are registered after `feature-book` and on by default. Released in 1.5.0.

# Decisions

- Board is one file, `.ai/project/board.md`, committed like everything under `.ai/project/`. Cards are public. At most two people work in parallel, so merge conflicts on it are rare; agents keep all cards on conflict.
- Every agent creates the board if missing and posts a card, even when alone — nobody has to switch parallel mode on.
- Agents pick a real name, not a feature slug, so the user can address them; Offtopic lines carry the sender as `[Name]`.
- No messaging area: a card line may address one agent with `@Name`, nothing more — delivery, read state and replies would turn it into the messaging system that was rejected.
- Agents read the board only at start, before leaving their topics and before committing, to keep focus.
- Sidenotes live at `.ai/project/sidenotes.md` per the `.ai/project/*` convention, read at start rather than auto-loaded by Boost.
- Sidenotes take only facts the user stated. Rules the user asks to remember go to `app.md` per the planning guideline. Agent findings go into their plan. Claude's own memory keeps working alongside.
- One sidenotes file grouped by `## <area>`, not one file per area like the idea pool: sidenotes are read whole at start, so split files would only add reads and risk a missed fact.
- No line limit on sidenotes; entries are pruned by whoever works on the topic.
- Compressed English telegraph style; Chinese rejected — no reliable token saving and the team could not maintain it.
- `tall-architect:sync` removed: projects only use `boost:update`.

# Open

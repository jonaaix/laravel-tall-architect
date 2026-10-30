# Board

Agents working in parallel share `.ai/project/board.md`, in exactly this format:

    # Board

    ## <Name>
    Feature: <feature>
    Topics: <topic>, <topic>
    - <what another card depends on>

    ## Offtopic
    - [<Name>] <anything else>

- At start read it (create if missing), pick a free name, add your card above Offtopic.
- Re-read before leaving your topics and before committing.
- A card line may start with `@Name` to address one agent.
- Remove your card and Offtopic lines when done. On conflict keep all cards.

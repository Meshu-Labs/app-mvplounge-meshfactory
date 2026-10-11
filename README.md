# app-mvplounge-meshfactory
Browser UI elements generated through a PHP Factory model.

This README is the primary summary for the platform.

## Documentation Model

- Docs entrypoint and namespace summary: [docs/.instructions.md](docs/.instructions.md)
- Detailed architecture encyclopedia: [docs/architecture/AX-overview.md](docs/architecture/AX-overview.md)
- Agent governance and operating policy: [AGENTS.md](AGENTS.md)

## Platform Summary

MeshFactory builds DOM and HTML element output through a predictable PHP factory structure:

- Enum layer defines elements and attributes.
- Abstract layer defines shared behavior and contracts.
- Concrete classes provide element-specific behavior.
- Attribute management remains the dynamic extension layer.

## Behavioral Clarification Workflow

Use the clarification workflow when evaluating new ideas, implementation examples, or edge-case behavior:

- Task definition: [docs/tasks/TK-architecture-clarification-task.md](docs/tasks/TK-architecture-clarification-task.md)
- Clarification reports folder: [docs/behavior](docs/behavior)

## Documentation Conventions

- Use domain-prefixed markdown names in docs domains using `{DomainCode}-{name}.md`.
- Domain codes: `AX` for Architecture, `BV` for Behavior, and `TK` for Task.
- Examples: `AX-system-overview.md`, `BV-20261011-initial-meshfactory-distribution.md`, and `TK-architecture-clarification-task.md`.
- Use lowercase directory names, for example architecture, tasks, and agents.
- Keep reserved index filenames in uppercase where conventional, for example README.md and AGENTS.md.

## Documentation Structure

- Docs entrypoint: docs/.instructions.md
- Architecture encyclopedia: docs/architecture/
- Behavioral clarifications: docs/behavior/
- Task workflows: docs/tasks/
- Agent governance docs: docs/agents/

## Installation

This package requires PHP 8.1 or later.

```bash
composer require mvplounge/meshfactory
```

Composer loads the package classes automatically. For manual bootstrap, include Composer's autoloader:

```php
require __DIR__ . '/vendor/autoload.php';
```


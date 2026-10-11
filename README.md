# app-mvplounge-meshfactory
Browser UI elements generated through a PHP Factory model.

This README is the primary summary for the platform.

## Documentation Model

- Primary summary: [docs/mesh-factory.md](docs/mesh-factory.md)
- Detailed architecture encyclopedia: [docs/architecture/README.md](docs/architecture/README.md)
- Agent governance and operating policy: [AGENTS.md](AGENTS.md)

## Platform Summary

MeshFactory builds DOM and HTML element output through a predictable PHP factory structure:

- Enum layer defines elements and attributes.
- Abstract layer defines shared behavior and contracts.
- Concrete classes provide element-specific behavior.
- Attribute management remains the dynamic extension layer.

## Architecture Clarification Workflow

Use the Architecture Clarification workflow when evaluating new ideas, implementation examples, or edge-case behavior:

- Task definition: [docs/tasks/architecture-clarification-task.md](docs/tasks/architecture-clarification-task.md)
- Clarification reports folder: [docs/architecture/clarifications](docs/architecture/clarifications)

## Documentation Conventions

- Use kebab-case for markdown filenames, for example mesh-factory.md and architecture-clarification-task.md.
- Use lowercase directory names, for example architecture, tasks, and agents.
- Keep reserved index filenames in uppercase where conventional, for example README.md and AGENTS.md.

## Documentation Structure

- Root summary: docs/mesh-factory.md
- Architecture encyclopedia: docs/architecture/
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


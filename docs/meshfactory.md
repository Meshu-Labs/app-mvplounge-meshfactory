# MvpLounge MeshFactory

This document is the namespace summary.

For detailed architecture, use the encyclopedia under [docs/architecture/README.md](architecture/README.md).

## Summary

MeshFactory builds HTML elements through a layered factory model:

- Enum layer defines element and attribute vocabulary.
- Abstract classes define shared behavior and family contracts.
- Concrete classes implement specific element behavior.
- Attribute handling is the dynamic extension surface.

## Core Concepts

- Shared DOM behavior is centralized in FactoryAbstract.
- Element-level behavior is centralized in FactoryElementAbstract.
- Naming conventions prioritize predictable inheritance.
- Compatibility is enforced through enum-driven contracts.

## Architecture Encyclopedia

- [System Overview](architecture/system-overview.md)
- [Factory Naming and Inheritance](architecture/factory-naming-and-inheritance.md)
- [Attribute Model and Deductions](architecture/attribute-model-and-deductions.md)
- [Supported Elements and Enums](architecture/supported-elements-and-enums.md)
- [Family Responsibilities](architecture/family-responsibilities.md)
- [Composer and Consumption](architecture/composer-and-consumption.md)

## Architecture Clarification

Use the Architecture Clarification task whenever a new concept, example, or implementation is proposed.

- Task definition: [tasks/architecture-clarification-task.md](tasks/architecture-clarification-task.md)
- Clarification report output folder: [architecture/clarifications](architecture/clarifications)
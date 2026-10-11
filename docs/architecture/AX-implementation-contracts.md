# AX Implementation Contracts

This document defines implementation contracts for MeshFactory architecture and code generation.

## Abstract Base Class Migration and Organization

All factory element abstractions must reside in `/src/MvpLounge/MeshFactory/Abstract/`.

Migration requirements:

- Move abstract classes from `/Element/` subdirectories (Field, Form, Links, Table) to `/Abstract/`.
- Update namespace declarations to `MvpLounge\MeshFactory\Abstract`.
- Update relative `require_once` paths:
  - Parent classes: `__DIR__ . '/FactoryElementAbstract.php'`
  - Sibling abstracts: `__DIR__ . '/FactoryElementFieldAbstract.php'`
  - Enums: `__DIR__ . '/../Enum/FactoryElement.php'`
- Keep concrete implementations in `/src/MvpLounge/MeshFactory/Element/{Domain}/`.
- Concrete implementations must require abstracts from `/Abstract/`.

## Concrete Implementation Update Requirements

When abstracts are migrated, update all concrete implementations immediately.

- Update `require_once` paths to `/Abstract/`.
- Replace static parent calls with `parent::` where appropriate.
- Ensure no `use` statements point to legacy abstract locations.

## HTML Element and Attribute Authority

Use these references as authoritative for elements and attributes:

- W3C HTML Standard: https://html.spec.whatwg.org/
- MDN HTML Docs: https://developer.mozilla.org/en-US/docs/Web/HTML/

Research order:

1. Validate in W3C spec.
2. Confirm practical behavior in MDN.
3. Verify enum coverage in `src/MvpLounge/MeshFactory/Enum/`.
4. Add missing enums before wiring behavior.

## Fluent Interface Contract

- All `add*()` methods must return `$this` or the correct fluent type.
- Preserve chainability for all builder-style APIs.

## Enum-Based Attribute Allowlisting

- Use enum-backed allowlists for supported elements and attributes.
- Validate with strict comparisons.
- Return `NULL` when an attribute is outside the allowlist.

## Parameter Processing Convention

- Constructors accept `$params = []`.
- Parent constructor orchestrates parameter dispatch.
- `__process_*()` methods each own one logical parameter group.

## Return Type Safety and Null Handling

- Use explicit return types.
- Use null-safe access where needed.
- Use sensible defaults for empty strings and arrays when contract requires non-null outputs.

## View Output Convention

When rendering variables in views, use null-coalescing fallback:

```php
<?= $value ?? '' ?>
```
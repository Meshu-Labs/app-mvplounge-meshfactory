# BV Quality Assurance Framework

This document defines behavioral quality gates for namespace-driven MeshFactory changes.

## Scope

Apply this framework to:

- Any touched PHP file.
- All related files in impacted domains.
- All concrete implementations when parent abstracts change.
- Path, namespace, or autoload-affecting edits.

## When Quality Checks Are Mandatory

Run quality checks:

1. After any file edit.
2. After abstract migrations.
3. After `require_once` path changes.
4. After namespace changes.
5. After bulk operations across a domain.

## Attribute Quality Check Phases

### Phase 1: Syntax Verification

```powershell
& "C:/xampp_devops_test/php/php.exe" -l <file>
```

### Phase 2: UTF-8 No-BOM Verification

```powershell
$bytes = [System.IO.File]::ReadAllBytes($filePath) | Select-Object -First 3
# Expected bytes: 3C 3F 70 (<?php)
# Invalid BOM bytes: EF BB BF
```

### Phase 3: Namespace and Path Verification

- Namespace matches file location.
- `<?php` is first bytes in file.
- `require_once` paths use `__DIR__` relative format.
- Concrete classes reference abstract parents from `/Abstract/`.

### Phase 4: Legacy Cleanup Verification

- Remove obsolete legacy files after migration.
- Confirm no remaining references to removed files.

## Required Outcomes

- No syntax errors across touched and affected files.
- UTF-8 no-BOM encoding for namespace-driven PHP files.
- No stale path references after migration.
- No static parent-call anti-patterns where `parent::` is required.
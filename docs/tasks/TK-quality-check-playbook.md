# TK Quality Check Playbook

This playbook provides operational procedures for running MeshFactory quality checks.

## Single File Checks

Syntax:

```powershell
& "C:/xampp_devops_test/php/php.exe" -l "<file>"
```

Encoding:

```powershell
$bytes = [System.IO.File]::ReadAllBytes("<file>") | Select-Object -First 3
($bytes | ForEach-Object { $_.ToString('X2') }) -join ' '
```

Expected first bytes: `3C 3F 70`

## Domain-Wide Checks

Use VS Code tasks from `.vscode/tasks.json`:

- `Quality Check: Current File`
- `Quality Check: Form Domain`
- `Quality Check: Field Domain`
- `Quality Check: Table Domain`
- `Quality Check: Links Domain`
- `Quality Check: All Domains`

## Bulk No-BOM Rewrite Procedure

```powershell
$content = Get-Content -Path '<file>' -Raw
[System.IO.File]::WriteAllText('<file>', $content, [System.Text.UTF8Encoding]::new($false))
```

After rewriting, rerun syntax and encoding checks.

## Clarification Report Generation

Use task: `Architecture Clarification: Create Report`

Outputs are written to `docs/behavior/` with `BV-` prefixed filenames.
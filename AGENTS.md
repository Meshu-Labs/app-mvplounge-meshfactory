# MeshFactory Code Generation Governance

This file defines repository-level rules for AI-assisted code generation targeting the MvpLounge MeshFactory library.

## UNIVERSAL: Quality Assurance for Namespace-Driven Codebases

**Mandatory for all PHP namespace-driven projects**

Quality assurance must be applied globally to any codebase relying on PHP namespaces, autoloading, or strict file organization. This is not optional and applies to:
- Any touched file during refactoring, migration, or feature work
- All related files in affected domains (even if not directly modified)
- All concrete implementations when abstracts change
- Cross-domain dependencies when paths or requires change

### When Quality Checks Are Required

Quality checks **MUST** be run:
1. **After any file edit** - Even single-line changes can introduce encoding issues or syntax errors
2. **After abstract migrations** - All concrete implementations in affected domains must pass checks
3. **After require_once path changes** - All files referencing the changed paths must be verified
4. **After namespace changes** - All use statements and autoload assumptions must be re-validated
5. **Bulk operations** - Any operation affecting multiple files requires domain-wide verification

### Bulk Quality Check Procedure

When multiple files in a domain are touched or affected:

```powershell
# Check all PHP files in a domain/directory
$domain = "c:\_src\app-mvplounge-meshfactory\src\MvpLounge\MeshFactory\Element\Table"
$failures = @()

Get-ChildItem $domain -Filter "*.php" | ForEach-Object {
    $lintResult = & "C:/xampp_devops_test/php/php.exe" -l $_.FullName 2>&1
    if ($lintResult -notmatch "No syntax errors") {
        $failures += @{
            File = $_.Name
            Error = $lintResult
        }
    }
    
    $bytes = [System.IO.File]::ReadAllBytes($_.FullName) | Select-Object -First 3
    $byteHex = ($bytes | ForEach-Object { $_.ToString('X2') }) -join ' '
    if ($byteHex -ne '3C 3F 70') {
        $failures += @{
            File = $_.Name
            Error = "BOM encoding detected: $byteHex"
        }
    }
}

if ($failures.Count -gt 0) {
    Write-Host "QUALITY CHECK FAILED - $($failures.Count) issues found"
    $failures | ForEach-Object { Write-Host "  $($_.File): $($_.Error)" }
} else {
    Write-Host "ALL FILES PASS - Domain quality verified"
}
```

### Bulk BOM Encoding Fix

When multiple files require encoding correction:

```powershell
# Re-encode all files in directory to UTF-8 no-BOM
$directory = "c:\_src\app-mvplounge-meshfactory\src\MvpLounge\MeshFactory\Element\Table"
$filesToFix = @("TableBody.php", "TableHead.php", "TableFooter.php", "TableRow.php", "TableRowBody.php")

foreach ($filename in $filesToFix) {
    $filePath = Join-Path $directory $filename
    if (Test-Path $filePath) {
        $content = Get-Content -Path $filePath -Raw
        [System.IO.File]::WriteAllText($filePath, $content, [System.Text.UTF8Encoding]::new($false))
        Write-Host "✓ Fixed: $filename"
    }
}

# Verify all files after bulk fix
Write-Host "`nVerifying bulk fix..."
Get-ChildItem $directory -Filter "*.php" | ForEach-Object {
    $result = & "C:/xampp_devops_test/php/php.exe" -l $_.FullName 2>&1
    $status = if ($result -match "No syntax errors") { "✓" } else { "✗" }
    Write-Host "$status $($_.Name)"
}
```

### Quality Check Automation Checklist

Every code change involving namespace-driven files should include:

- ✓ Syntax validation via `php -l` on every touched file
- ✓ Encoding validation (no BOM bytes `EF BB BF`)
- ✓ Domain-wide verification when abstracts or paths change
- ✓ Concrete implementation verification when parent classes change
- ✓ Cross-domain checks for transitive dependencies
- ✓ Documentation of any encoding corrections made

---

## Rule 1: Abstract Base Class Migration and Organization

All factory element abstractions must reside in `/src/MvpLounge/MeshFactory/Abstract/` directory.

Migration requirements:

- Move abstract classes from `/Element/` subdirectories (Field/, Form/, Links/, Table/) to `/Abstract/`
- Update namespace declarations to `MvpLounge\MeshFactory\Abstract`
- Update relative `require_once` paths to point to the new Abstract location:
  - Parent classes: `__DIR__ . '/FactoryElementAbstract.php'`
  - Sibling abstracts: `__DIR__ . '/FactoryElementFieldAbstract.php'`
  - Enums: `__DIR__ . '/../Enum/FactoryElement.php'`
- Keep concrete implementations (TextInput.php, RadioInput.php, etc.) in their Element/ subdirectories
- Concrete implementations should require Abstract classes from the new Abstract/ location:
  - Example: `require_once __DIR__ . '/../../Abstract/FactoryElementFieldInputAbstract.php'`
- **After migration: Run domain-wide quality checks on all concrete implementations in affected domains**

Abstract class naming convention:

- Use `FactoryElement{Domain}Abstract.php` format
- Example: `FactoryElementFieldAbstract.php`, `FactoryElementFormAbstract.php`
- Do not create legacy intermediate classes (e.g., avoid `FactoryElementFieldInputFactory.php` patterns)

## Rule 2: Attribute Quality Check (Complete Process)

All factory element abstractions must reside in `/src/MvpLounge/MeshFactory/Abstract/` directory.

Migration requirements:

- Move abstract classes from `/Element/` subdirectories (Field/, Form/, Links/, Table/) to `/Abstract/`
- Update namespace declarations to `MvpLounge\MeshFactory\Abstract`
- Update relative `require_once` paths to point to the new Abstract location:
  - Parent classes: `__DIR__ . '/FactoryElementAbstract.php'`
  - Sibling abstracts: `__DIR__ . '/FactoryElementFieldAbstract.php'`
  - Enums: `__DIR__ . '/../Enum/FactoryElement.php'`
- Keep concrete implementations (TextInput.php, RadioInput.php, etc.) in their Element/ subdirectories
- Concrete implementations should require Abstract classes from the new Abstract/ location:
  - Example: `require_once __DIR__ . '/../../Abstract/FactoryElementFieldInputAbstract.php'`

Abstract class naming convention:

- Use `FactoryElement{Domain}Abstract.php` format
- Example: `FactoryElementFieldAbstract.php`, `FactoryElementFormAbstract.php`
- Do not create legacy intermediate classes (e.g., avoid `FactoryElementFieldInputFactory.php` patterns)

## Rule 2: Attribute Quality Check (Complete Process)

The Attribute Quality Check is a multi-stage verification process that must be completed for every abstract class migration, concrete implementation update, and file edit.

### Phase 1: Syntax and Encoding Verification

Using the configured workspace PHP executable:

```powershell
& "C:/xampp_devops_test/php/php.exe" -l <file>
```

Required outcomes:

- No PHP syntax errors detected
- File readable and parseable
- **All concrete implementations must verify without errors after any updates to parent requires or method calls**

### Phase 2: UTF-8 Encoding Validation

Verify files are saved as UTF-8 without BOM:

```powershell
$bytes = [System.IO.File]::ReadAllBytes($filePath) | Select-Object -First 3
# Expected: 3C 3F 70 (<?php)
# NOT: EF BB BF (UTF-8 BOM)
```

Required outcomes:

- First 3 bytes are `3C 3F 70` (PHP opening tag)
- No BOM bytes (`EF BB BF`)
- File starts with `<?php` followed by optional namespace/declare
- If BOM detected, re-encode using: `[System.IO.File]::WriteAllText($path, $content, [System.Text.UTF8Encoding]::new($false))`

### Phase 3: Namespace and Path Verification

Manual review checklist:

- ✓ Namespace correctly declared to match file location
- ✓ `<?php` is absolutely first bytes (no output before namespace)
- ✓ `namespace` declaration follows optional `declare()` calls
- ✓ All `require_once` paths use relative `__DIR__` syntax
- ✓ Parent class `require_once` matches inheritance chain
- ✓ **Concrete implementations**: Require Abstract classes from `/Abstract/` directory
- ✓ **Concrete implementations**: Use `parent::methodName()` not static class calls

### Phase 4: Unused Legacy File Cleanup

After migration is complete, remove legacy files from original locations:

```powershell
Remove-Item -Path "Element/Field/FactoryElementFieldAbstract.php" -Force
Remove-Item -Path "Element/Form/FactoryElementFormAbstract.php" -Force
```

Required actions:

- Delete abstract classes from `Element/*/` subdirectories
- Verify no other files reference the deleted files via `require_once`
- Confirm concrete implementations have updated their `require_once` paths to `/Abstract/`
- Commit cleanup in the same change set as migration

## Rule 2: Concrete Implementation Update Requirements

When abstract classes are migrated to `/Abstract/`, all concrete implementations that extend them must be updated immediately.

Update requirements for concrete implementations:

- Update `require_once` paths to point to migrated abstracts in `/Abstract/`:
  - Before: `require_once __DIR__ . '/../Table/FactoryElementTableAbstract.php'`
  - After: `require_once __DIR__ . '/../../Abstract/FactoryElementTableAbstract.php'`
- Replace static class calls to parent class with instance method calls using `parent::`:
  - Before: `FactoryElementAbstract::getFactoryModel()`
  - After: `parent::getFactoryModel()`
- Verify no use statements reference the old Element/ location
- Run Attribute Quality Check Phase 1 (syntax and encoding) on all modified files:
  ```powershell
  & "C:/xampp_devops_test/php/php.exe" -l <file>  # Must output "No syntax errors"
  ```
- Files must run without syntax or runtime errors after update

Example: TableCell.php concrete implementation

```php
// BEFORE (legacy)
require_once __DIR__ . '/../Table/FactoryElementTableAbstract.php';
public function getFactoryModel(): array {
    return array_merge(
        FactoryElementAbstract::getFactoryModel(),  // ✗ Static call
        [/* ... */]
    );
}

// AFTER (corrected)
require_once __DIR__ . '/../../Abstract/FactoryElementTableAbstract.php';
public function getFactoryModel(): array {
    return array_merge(
        parent::getFactoryModel(),  // ✓ Instance method call
        [/* ... */]
    );
}
```

## Rule 3: HTML Element and Attribute Authority

Use the official HTML5 specification and W3C documentation as the authoritative source for element attributes and valid values.

Authoritative references:

- **W3C HTML Standard**: https://html.spec.whatwg.org/
- **MDN Web Docs**: https://developer.mozilla.org/en-US/docs/Web/HTML/
- **W3Schools HTML Reference**: https://www.w3schools.com/html/ (for quick lookup)

Research strategy for new elements/attributes:

1. Consult W3C spec for official element definition and allowed attributes
2. Check MDN for browser compatibility and real-world usage patterns
3. Verify enum definitions in `src/MvpLounge/MeshFactory/Enum/FactoryElement.php` and `FactoryElementAttribute.php`
4. Add missing attributes to enum before implementing factory methods
5. Document any deprecated or browser-specific attributes in inline comments

Common form element attributes (reference):

- **Form element**: action, method, enctype, novalidate, target, autocomplete, accept-charset
- **Input element**: type, name, value, placeholder, required, disabled, readonly, minlength, maxlength, pattern, step, min, max, checked, accepted
- **Textarea element**: name, rows, cols, placeholder, required, disabled, readonly
- **Select element**: name, multiple, disabled, required, size
- **Option element**: value, selected, disabled, label
- **Link element**: href, rel, target, hreflang, media, type, ping, referrerpolicy
- **Table elements**: colspan, rowspan, scope, headers, abbr (for cells); border, cellspacing, cellpadding (for tables)

## Rule 4: Fluent Interface Contract

All factory classes must implement fluent (builder) interface pattern.

Requirements:

- All `add*()` methods return `$this` (or appropriate class type)
- Enable method chaining: `$factory->addField()->addLabel()->addValue()`
- Use return type declarations: `public function addLabel($label): FactoryElementFieldAbstract`
- Maintain immutability during chain construction

## Rule 5: Enum-Based Attribute Allowlisting

All factory elements must use enum-based allowlists to validate supported attributes.

Requirements:

- `AllowedFactoryElements` array contains `FactoryElement` enum values
- `AllowedFactoryElementAttributes` array contains `FactoryElementAttribute` enum values
- In getter methods, check: `in_array(FactoryElementAttribute::NAME->value, $allowed, TRUE)`
- Return NULL if attribute not in allowlist to prevent invalid HTML output

Example pattern:

```php
protected array $AllowedFactoryElementAttributes = [
    FactoryElementAttribute::NAME,
    FactoryElementAttribute::TYPE,
    FactoryElementAttribute::VALUE
];

public function getFactoryElementFieldValue(array $allowed)
{
    return in_array(FactoryElementAttribute::VALUE->value, $allowed, TRUE) 
        ? $this->getElementFieldValue() 
        : NULL;
}
```

## Rule 6: Parameter Processing Convention

All factory classes use a standardized `__process_*()` method pattern in constructors.

Requirements:

- Constructor accepts `$params` array: `public function __construct($params = [])`
- Call parent constructor: `parent::__construct($params)`
- Parent calls `$this->__process_params($params)` which dispatches to `__process_*()` methods
- Each `__process_*()` method handles one logical parameter group

Example pattern:

```php
protected function __process_type($params): void
{
    if (!empty($params['type'])) {
        $this->addType($params['type']);
    }
}

public function addType($type): FactoryElementFieldInputAbstract
{
    // Type validation and assignment
    return $this;
}
```

## Rule 7: Return Type Safety and Null-Coalescing

All getter methods must use null-safe operations and proper return types.

Requirements:

- Use null-coalescing for property access: `$this->property ?? NULL`
- Method return types must match contract (use `?string`, `?bool`, `?int`, `array`, etc.)
- For string returns, default to empty string when nullable: `?? ''`
- For array returns, default to empty array: `?? []`
- Always cascade type-safe returns through the chain

Example pattern:

```php
public function getElementFieldType(): ?string
{
    return $this->FactoryElementFieldType?->value;
}
```

## Rule 8: Short Echo Tags in Views

When rendering variables in view templates, always use null-coalescing fallback.

Required output pattern in views:

```php
<?= $value ?? '' ?>
```

Guidelines:

- Never output undefined variables directly
- Provide type-appropriate fallback values
- For HTML attributes, use empty string fallback
- For boolean attributes, provide explicit boolean or empty string

# Sandbox Factory Tests

Sandbox scripts for MeshFactory are organized by domain under `src/MvpLounge/Sandbox/MeshFactory/`:

- Field
- Form
- Html
- Links
- Table

Each domain is organized by test type:

- Generic
- Factory
- Params

Each sandbox script now validates:

1. Default factory initialization with no constructor params.
2. Fluent factory usage without constructor params until compileAsArray or compleAsHtmlString inspection.
3. Constructor-param rendering where all supported attributes for the tested factory appear in the rendered `compleAsHtmlString()` output.

Use-case standards:

1. Generic use case: default constructor and baseline contract assertions.
2. Factory use case: fluent chaining style such as addContent, addClass, addId, then compleAsHtmlString().
3. Param use case: constructor params from exhaustive allowed attribute keys followed by compleAsHtmlString().

These scripts are intentionally verbose standalone examples and do not rely on shared coverage assertion helpers.
Each script includes explicit try/catch blocks with structured error output for human and AI-readable parsing.

Html Params sandbox (`Html/Params/html-elements-sandbox.php`) discovers element classes recursively to support domainized namespaces under `MeshFactory/Element/Html/{Domain}/`.

Run all MeshFactory sandbox scripts:

```powershell
& "C:/xampp_devops_test/php/php.exe" "c:/_src/app-mvplounge-meshfactory/src/MvpLounge/Sandbox/MeshFactory/run-all.php"
```

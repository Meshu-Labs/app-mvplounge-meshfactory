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

## Sandbox Test-Type Standard

Library sandbox suites are organized under `src/MvpLounge/Sandbox/{Library}/`.

For MeshFactory, sandbox tests are split by test type under each domain folder in `src/MvpLounge/Sandbox/MeshFactory/`:

- `Generic/`
- `Factory/`
- `Params/`

Each domain should provide scripts per type using structured try/catch output.

The test-type scripts are written as standalone, explicit examples with local assertions only, so downstream consumers can copy real-world usage patterns directly.

Run the MeshFactory sandbox suite through the library runner:

```powershell
& "C:/xampp_devops_test/php/php.exe" "c:/_src/app-mvplounge-meshfactory/src/MvpLounge/Sandbox/MeshFactory/run-all.php"
```

## Bulk No-BOM Rewrite Procedure

```powershell
$content = Get-Content -Path '<file>' -Raw
[System.IO.File]::WriteAllText('<file>', $content, [System.Text.UTF8Encoding]::new($false))
```

After rewriting, rerun syntax and encoding checks.

## Clarification Report Generation

Use task: `Architecture Clarification: Create Report`

Outputs are written to `docs/behavior/` with `BV-` prefixed filenames.

## Branching and Publishing Setup (Administrator)

These files do not activate repository settings by themselves. An administrator must complete this setup:

1. Install the workflows on both `main` and `dev` before enabling protection. The branch-policy workflow uses `pull_request_target` to evaluate trusted base-branch code; it never checks out or executes PR code. The quality workflow runs untrusted PR code with read-only permissions and no publishing secrets.
2. In Settings → General, change the default branch to `dev`.
3. In Settings → Rules → Rulesets, import `.github/rulesets/dev.json` and `.github/rulesets/main.json`. Confirm both are active, with no bypass actors. Both require one approval, approval of the latest push, resolved discussions, current passing `Branch policy` and `PHP quality` checks from GitHub Actions, and prohibit force pushes and deletion. Requiring PRs blocks direct pushes.
4. Keep merge commits enabled. Merge promotion PRs with **Create a merge commit**, not squash or rebase, so repeated `dev` → `main` promotions retain shared history. After each promotion, create a temporary synchronization branch from the latest `dev`, merge `main` into it, and submit a reviewed PR back to `dev` using a merge commit before the next promotion. If `dev` advances, update the synchronization branch with `dev` again. This avoids deadlocking protected branches when development continues during promotion; strict status checks require `dev` to include the latest `main`. Bring developer branches up to date with `dev` before merging. GitHub cannot enforce the original branch point.
5. Create environments named `packagist` and `release`. For each, select **Selected branches and tags**, allow only the **branch** `main`, and add required reviewers if your GitHub plan supports them. Do not allow deployment from tags or developer branches. Environment restrictions are essential: workflow guards alone can be edited on a feature branch.
6. In the `packagist` environment only, add `PACKAGIST_USERNAME` and `PACKAGIST_API_TOKEN` secrets for a Packagist maintainer with access to `mvplounge/meshfactory`. Prefer a package-scoped update token. Do not place these secrets at repository scope.
7. In the existing Packagist package settings, verify the repository URL is `https://github.com/Meshu-Labs/mvplounge-meshfactory-php`. Updating the wrong repository will not update this package. The workflow requests a Packagist refresh; it does not upload an artifact. Packagist indexes branches and tags, including `dev` as a development version; consumers should use stable tagged versions for releases.
8. Protect release tags (`v*`) against unauthorized creation, updates, and deletion using an administrator-managed tag ruleset. Allow the release automation to create tags without allowing developers to rewrite them. Account for any other organization rulesets.

Developers branch from `dev` and open PRs back to `dev`. Promotion PRs must come from this repository's `dev` branch, target `main`, and be authored by `mcs-labs-dk`, `meshucs`, `Copilot`, or `copilot-swe-agent[bot]`. Copilot is subject to the same review and check requirements; it has no protection bypass. Open promotion PRs manually or ask Copilot to open them; there is no automatic PR-creation workflow.

Merges into `main` automatically request a Packagist update. To release, `mcs-labs-dk` or `meshucs` runs **Publish** using **Run workflow**, selecting `main` and a new stable tag such as `v1.0.0`. The workflow tags the exact `main` commit selected at dispatch, creates a GitHub release, and refreshes Packagist. Composer derives versions from Git tags rather than a fixed `version` field. Publishing needs no source checkout or Composer execution.

If Packagist fails after a release, rerun only the failed publishing job; do not reuse the release tag to create another release. If release creation fails after tag creation, an administrator must inspect the partial state before retrying.

Changes to workflows and rulesets are security-sensitive and must be reviewed carefully. Repository-admin permissions are needed to activate rulesets, set the default branch, and configure environments. Verify ruleset availability for your GitHub plan before treating the strategy as enforced.
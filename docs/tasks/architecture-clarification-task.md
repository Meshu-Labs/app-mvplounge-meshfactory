# Architecture Clarification Task

This task validates whether a proposed implementation or use case fits MeshFactory architecture.

## Inputs

- Question, proposal, input, or code example
- Relevant feature context
- Constraints (performance, compatibility, security, maintainability)

## Required Workflow

### 1) Feasibility Research

- Determine whether the implementation aligns with existing architecture.
- Confirm where the behavior belongs in current inheritance and enum structure.
- Identify whether the idea extends existing patterns or introduces a new pattern.

### 2) Critical Push-Back Analysis

Provide direct push-back and risk analysis for:

- Compatibility
- Style consistency
- Performance
- Security
- Functionality correctness
- Efficiency of code usage and maintainability

### 3) Hybrid Recommendation Synthesis

- Compare strict style compliance versus experimental value.
- Recommend a hybrid path that preserves platform consistency while enabling useful experimentation.
- Ensure recommendations are concrete, unique, and implementation-ready.

### 4) Documentation Terminology Alignment

- Link findings to root README and architecture docs.
- Use exact project terminology that authors use.
- Ensure recommendations do not invent alternate naming for existing architecture concepts.

## Output Format

Use this structure in clarification reports:

1. Input Summary
2. Architecture Fit Assessment
3. Push-Back and Risks
4. Hybrid Recommendation
5. Terminology and Documentation Linkage
6. Implementation Decision
7. Follow-up Documentation Updates

## Documentation Linkage Checklist

- Root summary source: README.md
- Namespace summary source: docs/meshfactory.md
- Detailed architecture source: docs/architecture/README.md and topic pages
- Task source folder: docs/tasks/
- Agent governance source: AGENTS.md and docs/agents/repository-governance.md

# Attribute Model and Deductions

## Primary Principle

Attribute handling is the dynamic layer of MeshFactory.

## Deduction Flow

1. Start with the element enum.
2. Check AllowedFactoryElementAttributes on the class.
3. Walk inheritance to reuse parent behavior before adding logic.
4. Publish final opening-tag properties through getFactoryAttributePropertyCollection().

## Collection and Rendering Contract

- addElementOpen() consumes getFactoryAttributePropertyCollection().
- The property collection must represent only opening-tag attributes for the current element.
- Model payloads belong in getFactoryModel() and related model methods.

## Control Checks

- Confirm class-level ownership of getAllowedFactoryElementAttributes() when behavior is specialized.
- Keep getFactoryAttributePropertyCollection() aligned with the rendering contract.
- Start collection from the default base collection.
- Use enum value checks for allowed attributes.
- Keep per-attribute helper methods explicit and predictable.

## Attribute Scope Refinement Rule

- Constructor params and fluent attribute methods should only expose attributes that are valid for the class opening tag.
- Effective sandbox and runtime attribute scope is the union of:
	- `FactoryAbstract::$FactoryElementAttributes`
	- the active class-chain `AllowedFactoryElementAttributes`
- If more than five derived FactoryElement classes inherit `AllowedFactoryElementAttributes` they do not use, introduce or refine an intermediate `FactoryElement*Abstract` with a narrower allowed-attribute set.
- Keep the opening-tag contract minimal: broad inherited attribute pools should be treated as a design smell and refactored.

## Field and HTML5 Guidance

- Input classes should expose input-specific opening-tag attributes.
- Select classes should expose select opening-tag attributes.
- Option classes should expose option opening-tag attributes.
- Leaf-only attributes should stay fully on that leaf class chain.
- If a required enum value is missing, add it in the correct enum family first.

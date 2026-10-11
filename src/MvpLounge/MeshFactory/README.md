# MvpLounge MeshFactory

This namespace builds HTML elements from PHP classes. Keep the structure simple and predictable.

## What This Library Does

This package builds HTML elements from PHP classes. The enum layer defines the available element types and attributes, and the factory classes turn those into renderable markup.

The main idea is simple:

- `FactoryAbstract` (in namespace `MvpLounge\MeshFactory\Abstract`) handles shared DOM attribute data.
- `FactoryElementAbstract` (in namespace `MvpLounge\MeshFactory\Abstract`) handles element-level behavior.
- Each enum-backed element maps to a DOM element and its TypeScript counterpart.
- Attribute handling is the only part that stays dynamic.

That keeps the structure predictable while still leaving room for different rendering targets.

## Factory Naming Convention

Base abstract classes follow the naming convention:
- `FactoryElement{DomDomain}Abstract` for domain-specific abstracts
- Examples: `FactoryElementTableAbstract`, `FactoryElementFormAbstract`, `FactoryElementFieldAbstract`, `FactoryElementHtml5Abstract`, `FactoryElementLinkAbstract`

All abstract factory base classes are located in the `MvpLounge\MeshFactory\Abstract` namespace.

## How Attribute Rules Are Deduced

- Start with the element enum. If a class extends one of those enum-backed elements, it is part of the HTML/DOM shape for that element.
- Check `AllowedFactoryElementAttributes` on the class. That is the main source for which attributes the class is allowed to expose.
- Walk the inheritance chain before adding new logic. If the parent already exposes the right behavior, reuse it.
- Use `getFactoryAttributePropertyCollection()` to publish the final property set for rendering.
- Use helper methods for per-attribute checks when the class has special behavior or needs to gate values.
- Use the class process methods and render methods as a cross-check. If a method like `__process_*` or `getElementFactoryOpen()` already consumes an attribute, the collection method should expose it too.
- For table, form, field, html5, and link classes, the allowed attributes usually come from the family-specific enum plus any shared DOM attributes.
- Treat the attribute layer as the only dynamic layer. The class structure itself should stay deductive and stable.

## What This Library Is For

- This library is the HTML factory layer for larger UI work.
- It is meant to connect cleanly to `APP-MESH-UI` and TypeScript-based component construction.
- It should also stay useful for templating integration in ExpressionEngine, WordPress, osTicket, and possibly Drupal.

## Writing Style

- Keep the implementation practical.
- Favor clear logic over clever logic.
- Use the library to show real PHP features, common patterns, and common mistakes.
- Avoid overengineering. If a rule can live in one base class, keep it there.

## Current Focus

- The dynamic part of the library is attribute management.
- The rest of the shape should stay stable and predictable.

## Supported Elements

The supported DOM/HTML elements currently come from `FactoryElement`:

- Core text and media: `p`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `hl`, `img`
- Field and form: `fieldset`, `input`, `select`, `option`, `textarea`, `form`
- Link and layout: `a`, `div`, `span`, `label`, `aside`, `content`, `header`, `figure`, `main`, `section`, `article`, `footer`, `nav`
- Table: `th`, `td`, `tr`, `table`, `thead`, `tfoot`, `tbody`

## Supported Attribute Enums

Use these enums as the source of truth for attribute support:

- Elements: `FactoryElement`
- Attributes (shared + element-specific): `FactoryElementAttribute`
- Field input types: `FactoryElementFieldType`
- Primitive value types: `FactoryElementPrimativeType`

## Family Notes

- `FactoryBase` owns the shared DOM attributes and base collection shape.
- `FactoryElementBase` owns element-level behavior, allowed elements, and element-specific collection rules.
- `FieldFactoryBase` and its descendants handle form input behavior and value typing.
- `Html5FactoryBase` and its descendants handle the smaller HTML5-only attribute set.
- `LinkFactoryBase` handles anchor/link-specific attribute behavior.
- `TableFactoryBase` handles table, row, cell, head, and body behavior.
- `FormFactoryBase` handles form-wide attributes and form child composition.

## Composer

This library is ready to be consumed as a Composer package.

### Install

```bash
composer require mvplounge/meshfactory
```

### Autoload

```php
require __DIR__ . '/vendor/autoload.php';
```

### Package Build (local)

```bash
composer validate
```
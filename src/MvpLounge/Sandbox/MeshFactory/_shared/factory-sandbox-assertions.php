<?php

declare(strict_types=1);

function sandboxAssertTrue(bool $condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function sandboxAssertSameFactoryInstance(object $factory, string $method, array $arguments, string $label): void
{
    if (!method_exists($factory, $method)) {
        return;
    }

    $result = $factory->{$method}(...$arguments);
    sandboxAssertTrue($result === $factory, $label . ': ' . $method . '() must return the same factory instance');
}

function sandboxAssertFluentFactoryLifecycle(object $factory, string $label): void
{
    $resolvedElement = sandboxResolveFactoryElementValue($factory);

    $methodArguments = [
        'addId' => ['sandbox_id'],
        'addClass' => ['sandbox_class'],
        'addTitle' => ['Sandbox Title'],
        'addStyle' => ['display:block'],
        'addLang' => ['en'],
        'addDir' => ['ltr'],
        'addHidden' => ['hidden'],
        'addTabindex' => [2],
        'addDraggable' => ['true'],
        'addContenteditable' => ['true'],
        'addSpellcheck' => ['true'],
        'addTranslate' => ['yes'],
        'addRole' => ['button'],
        'addAriaLabel' => ['Sandbox Aria Label'],
        'addAriaLabelledby' => ['sandbox-labelledby'],
        'addAriaDescribedby' => ['sandbox-describedby'],
        'addName' => ['sandbox_name'],
        'addContent' => ['Sandbox Content'],
        'addElement' => [$resolvedElement ?? 'div'],
        'addHref' => ['https://example.com'],
        'addRel' => ['noopener'],
        'addTarget' => ['_blank'],
        'addHrefLang' => ['en'],
        'addMedia' => ['screen'],
        'addPing' => ['https://example.com/ping'],
        'addReferrerPolicy' => ['no-referrer'],
        'addLinkType' => ['text/html'],
        'addAction' => ['/submit'],
        'addEnc' => ['multipart/form-data'],
        'addAutoComplete' => ['on'],
        'addMethod' => ['post'],
        'addNoValidate' => ['novalidate'],
        'addActivity' => ['/activity'],
        'addAccess' => [true],
        'addAct' => ['view'],
        'addFieldset' => [['id' => 'fieldset_id']],
        'addLabel' => ['Sandbox Label'],
        'addLength' => [10],
        'addValueType' => ['string'],
        'addValue' => ['sandbox-value'],
        'addType' => ['text'],
        'addColspan' => [2],
        'addRowspan' => [3],
        'addScope' => ['col'],
        'addHeaders' => ['header-id'],
        'addAbbr' => ['abbr'],
        'addCellspacing' => [0],
        'addCellpadding' => [1],
        'addBorder' => [1],
        'addChecked' => [true],
        'addCheckedElements' => [[['name' => 'sandbox_name', 'value' => 'sandbox-value']]],
        'addPlaceholder' => ['Sandbox Placeholder'],
        'addSelected' => [true],
        'addFor' => ['sandbox_for_id'],
    ];

    foreach ($methodArguments as $method => $arguments) {
        sandboxAssertSameFactoryInstance($factory, $method, $arguments, $label);
    }

    sandboxAssertTrue(method_exists($factory, 'compile'), $label . ': missing compile()');
    sandboxAssertTrue(is_array($factory->compile()), $label . ': compile() must return an array');
}

function sandboxResolveFactoryElementValue(object $factory): ?string
{
    $reflection = new ReflectionObject($factory);

    while ($reflection) {
        if ($reflection->hasProperty('FactoryElement')) {
            $property = $reflection->getProperty('FactoryElement');
            $property->setAccessible(true);
            $value = $property->getValue($factory);

            if ($value instanceof BackedEnum) {
                return (string) $value->value;
            }
        }

        $reflection = $reflection->getParentClass();
    }

    return null;
}

function sandboxSampleAttributeValue(string $attribute): mixed
{
    return match ($attribute) {
        'id' => 'sandbox_id',
        'name' => 'sandbox_name',
        'class' => 'sandbox_class',
        'title' => 'Sandbox Title',
        'style' => 'display:block',
        'lang' => 'en',
        'dir' => 'ltr',
        'hidden' => 'hidden',
        'tabindex' => 2,
        'draggable' => 'true',
        'contenteditable' => 'true',
        'spellcheck' => 'true',
        'translate' => 'yes',
        'role' => 'button',
        'aria-label' => 'Sandbox Aria Label',
        'aria-labelledby' => 'sandbox-labelledby',
        'aria-describedby' => 'sandbox-describedby',
        'href' => 'https://example.com',
        'target' => '_blank',
        'rel' => 'noopener',
        'action' => '/submit',
        'method' => 'post',
        'enctype' => 'multipart/form-data',
        'novalidate' => 'novalidate',
        'placeholder' => 'Sandbox Placeholder',
        'type' => 'text',
        'value' => 'sandbox-value',
        'rows' => 3,
        'cols' => 10,
        'colspan' => 2,
        'rowspan' => 3,
        'scope' => 'col',
        'headers' => 'h1',
        'abbr' => 'abbr',
        'selected' => true,
        'checked' => true,
        'cellspacing' => 0,
        'cellpadding' => 1,
        'border' => 1,
        'access' => true,
        'for' => 'sandbox_for_id',
        default => 'sandbox-' . $attribute
    };
}

function sandboxBuildAllowedAttributeParams(object $factory): array
{
    $params = ['id' => sandboxSampleAttributeValue('id')];

    if (!method_exists($factory, 'getAllowedFactoryElementAttributes')) {
        return $params;
    }

    foreach ($factory->getAllowedFactoryElementAttributes() as $attribute) {
        if (!is_string($attribute) || $attribute === '' || $attribute === 'data') {
            continue;
        }

        $params[$attribute] = sandboxSampleAttributeValue($attribute);
    }

    return $params;
}

function sandboxAssertOpenTagAttributes(string $openTag, array $params): void
{
    foreach ($params as $attribute => $value) {
        if ($attribute === 'data') {
            continue;
        }

        if ($attribute === 'selected' || $attribute === 'checked') {
            if ($value === true) {
                sandboxAssertTrue(str_contains($openTag, $attribute), 'Missing boolean attribute: ' . $attribute . ' in tag: ' . $openTag);
            }
            continue;
        }

        if ($attribute === 'access') {
            sandboxAssertTrue(str_contains($openTag, 'enabled') || str_contains($openTag, 'disabled'), 'Missing translated access attribute in tag: ' . $openTag);
            continue;
        }

        if (is_array($value) || is_object($value) || $value === null) {
            continue;
        }

        $expected = sprintf('%s="%s"', $attribute, (string) $value);
        sandboxAssertTrue(str_contains($openTag, $expected), 'Missing attribute pair: ' . $expected . ' in tag: ' . $openTag);
    }
}

function sandboxAssertFactoryCoverage(object $factory, string $label): void
{
    sandboxAssertTrue(method_exists($factory, 'getAllowedFactoryElementAttributes'), $label . ': missing getAllowedFactoryElementAttributes()');
    sandboxAssertTrue(method_exists($factory, 'getDefaultFactoryAttributePropertyCollection'), $label . ': missing getDefaultFactoryAttributePropertyCollection()');
    sandboxAssertTrue(method_exists($factory, 'getFactoryAttributePropertyCollection'), $label . ': missing getFactoryAttributePropertyCollection()');

    $defaultCollection = $factory->getDefaultFactoryAttributePropertyCollection();
    sandboxAssertTrue(is_array($defaultCollection), $label . ': default collection must be an array');

    foreach (['configuration', 'user', 'system', 'data'] as $requiredKey) {
        sandboxAssertTrue(array_key_exists($requiredKey, $defaultCollection), $label . ': default collection missing key ' . $requiredKey);
    }

    $factoryCollection = $factory->getFactoryAttributePropertyCollection();
    sandboxAssertTrue(is_array($factoryCollection), $label . ': factory collection must be an array');

    $element = sandboxResolveFactoryElementValue($factory);
    sandboxAssertTrue(is_string($element) && $element !== '', $label . ': failed to resolve FactoryElement value');

    sandboxAssertFluentFactoryLifecycle($factory, $label);

    $params = sandboxBuildAllowedAttributeParams($factory);
    $openTag = $factory->getElementFactoryOpen($element, $params);

    sandboxAssertTrue(is_string($openTag) && $openTag !== '', $label . ': getElementFactoryOpen returned empty string');
    sandboxAssertTrue(str_starts_with($openTag, '<' . $element), $label . ': opening tag mismatch. Tag: ' . $openTag . ' element: ' . $element);

    sandboxAssertOpenTagAttributes($openTag, $params);
}

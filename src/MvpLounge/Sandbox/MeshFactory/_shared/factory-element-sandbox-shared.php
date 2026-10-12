<?php

declare(strict_types=1);

if (!function_exists('mfAssert')) {
    function mfAssert(bool $condition, string $message): void
    {
        if (!$condition) {
            throw new RuntimeException($message);
        }
    }
}

if (!function_exists('mfBaseAttributeValues')) {
    function mfBaseAttributeValues(string $suffix): array
    {
        return [
            'id' => 'el_id_' . $suffix,
            'class' => 'el-class-' . $suffix,
            'title' => 'Element title ' . $suffix,
            'style' => 'display:block',
            'lang' => 'en',
            'dir' => 'ltr',
            'hidden' => 'hidden',
            'tabindex' => 7,
            'draggable' => 'false',
            'contenteditable' => 'false',
            'spellcheck' => 'false',
            'translate' => 'no',
            'role' => 'presentation',
            'aria-label' => 'aria-label-' . $suffix,
            'aria-labelledby' => 'aria-labelledby-' . $suffix,
            'aria-describedby' => 'aria-describedby-' . $suffix
        ];
    }
}

if (!function_exists('mfAttributeSampleValue')) {
    function mfAttributeSampleValue(string $attribute, string $suffix)
    {
        switch ($attribute) {
            case 'href':
                return 'https://example.test/' . $suffix;
            case 'target':
                return '_self';
            case 'rel':
                return 'noopener noreferrer';
            case 'action':
                return '/submit/' . $suffix;
            case 'method':
                return 'post';
            case 'enctype':
                return 'multipart/form-data';
            case 'novalidate':
                return 'novalidate';
            case 'autocomplete':
                return 'on';
            case 'placeholder':
                return 'placeholder_' . $suffix;
            case 'type':
                return 'text';
            case 'value':
                return 'value_' . $suffix;
            case 'rows':
                return 3;
            case 'cols':
                return 12;
            case 'colspan':
                return 2;
            case 'rowspan':
                return 2;
            case 'scope':
                return 'col';
            case 'headers':
                return 'h1 h2';
            case 'abbr':
                return 'abbr_' . $suffix;
            case 'selected':
                return true;
            case 'checked':
                return true;
            case 'cellspacing':
                return 0;
            case 'cellpadding':
                return 1;
            case 'border':
                return 1;
            case 'access':
                return true;
            case 'alt':
                return 'alt_' . $suffix;
            case 'src':
                return '/assets/' . $suffix . '.png';
            case 'for':
                return 'field_' . $suffix;
            case 'hreflang':
                return 'en-US';
            case 'media':
                return 'screen';
            case 'ping':
                return 'https://example.test/ping/' . $suffix;
            case 'referrerpolicy':
                return 'no-referrer';
            case 'name':
                return 'name_' . $suffix;
            case 'data':
                return [
                    'qa' => $suffix,
                    'component' => 'meshfactory'
                ];
            case 'content':
                return 'params-content-' . $suffix;
            case 'srcset':
                return '/assets/' . $suffix . '-1x.png 1x, /assets/' . $suffix . '-2x.png 2x';
            case 'sizes':
                return '(max-width: 600px) 100vw, 50vw';
            case 'crossorigin':
                return 'anonymous';
            case 'integrity':
                return 'sha384-testhash-' . $suffix;
            case 'as':
                return 'script';
            case 'fetchpriority':
                return 'high';
            case 'preload':
                return 'metadata';
            case 'poster':
                return '/assets/' . $suffix . '-poster.png';
            case 'autoplay':
            case 'controls':
            case 'loop':
            case 'muted':
            case 'disabled':
            case 'default':
                return true;
            case 'form':
                return 'form_' . $suffix;
            case 'min':
                return '0';
            case 'max':
                return '100';
            case 'step':
                return '5';
            case 'high':
                return '80';
            case 'low':
                return '20';
            case 'optimum':
                return '50';
            case 'kind':
                return 'captions';
            case 'srclang':
                return 'en';
            default:
                return $attribute . '_' . $suffix;
        }
    }
}

if (!function_exists('mfProcessableAttributeKeys')) {
    function mfProcessableAttributeKeys(object $factory): array
    {
        $reflection = new ReflectionClass($factory);
        $attributes = [];

        foreach ($reflection->getMethods() as $method) {
            $name = $method->getName();
            if (!preg_match('/^__process_(.+)$/', $name, $matches)) {
                continue;
            }

            $attribute = strtolower(trim((string) $matches[1]));
            if ($attribute === '') {
                continue;
            }

            $attributes[$attribute] = true;
        }

        return array_keys($attributes);
    }
}

if (!function_exists('mfIsUnsafeGeneratedAttribute')) {
    function mfIsUnsafeGeneratedAttribute(string $attribute): bool
    {
        static $unsafe = [
        'configuration',
        'element',
        'ext',
        'system',
        'user',
        'params'
        ];

        return in_array($attribute, $unsafe, true);
    }
}

if (!function_exists('mfAllowedAttributeValues')) {
    function mfAllowedAttributeValues(object $factory, string $suffix): array
    {
        $allowed = [];
        if (method_exists($factory, 'getAllowedFactoryElementAttributes')) {
            $allowed = $factory->getAllowedFactoryElementAttributes();
        }

        if (!is_array($allowed)) {
            return [];
        }

        $attributeKeys = [];
        foreach ($allowed as $attribute) {
            if (!is_string($attribute)) {
                continue;
            }

            $_attribute = strtolower(trim($attribute));
            if ($_attribute === '') {
                continue;
            }

            $attributeKeys[$_attribute] = true;
        }

        foreach (mfProcessableAttributeKeys($factory) as $_attribute) {
            $attributeKeys[$_attribute] = true;
        }

        $values = [];
        foreach (array_keys($attributeKeys) as $_attribute) {
            if (mfIsUnsafeGeneratedAttribute($_attribute)) {
                continue;
            }
            $values[$_attribute] = mfAttributeSampleValue($_attribute, $suffix);
        }

        return $values;
    }
}

if (!function_exists('mfBuildScopedParams')) {
    function mfBuildScopedParams(object $factory, string $suffix): array
    {
        $params = [];
        $processable = mfProcessableAttributeKeys($factory);

        foreach (mfBaseAttributeValues($suffix) as $attribute => $value) {
            $params[$attribute] = $value;
        }

        foreach (mfAllowedAttributeValues($factory, $suffix) as $attribute => $value) {
            $params[$attribute] = $value;
        }

        echo '-- Discoverable processable params: ' . get_class($factory) . ' --' . PHP_EOL;
        print_r($processable);
        echo '-- End discoverable processable params --' . PHP_EOL;

        echo '-- Params payload: ' . get_class($factory) . ' --' . PHP_EOL;
        print_r($params);
        echo '-- End params payload --' . PHP_EOL;

        return $params;
    }
}

if (!function_exists('mfMethodForAttribute')) {
    function mfMethodForAttribute(string $attribute): string
    {
        $normalized = str_replace(['-', '_'], ' ', strtolower($attribute));
        return 'add' . str_replace(' ', '', ucwords($normalized));
    }
}

if (!function_exists('mfCollectOutputs')) {
    function mfCollectOutputs(object $factory): array
    {
        $arrayData = method_exists($factory, 'compileAsArray') ? $factory->compileAsArray() : null;
        $compileData = method_exists($factory, 'compile') ? $factory->compile() : null;
        $jsonData = method_exists($factory, 'compileAsJson') ? $factory->compileAsJson() : null;
        $htmlData = method_exists($factory, 'compleAsHtmlString') ? $factory->compleAsHtmlString() : null;
        $stringData = method_exists($factory, 'string') ? $factory->string() : null;

        return [
            'arrayData' => is_array($arrayData) ? $arrayData : null,
            'compileData' => is_array($compileData) ? $compileData : null,
            'jsonData' => is_string($jsonData) ? $jsonData : null,
            'htmlData' => is_string($htmlData) ? $htmlData : null,
            'stringData' => is_string($stringData) ? $stringData : null
        ];
    }
}

if (!function_exists('mfCollectStrings')) {
    function mfCollectStrings($value): array
    {
        if (is_string($value)) {
            return [$value];
        }

        if (!is_array($value)) {
            return [];
        }

        $strings = [];
        foreach ($value as $item) {
            $strings = array_merge($strings, mfCollectStrings($item));
        }

        return $strings;
    }
}

if (!function_exists('mfExtractMarkup')) {
    function mfExtractMarkup(array $outputs): string
    {
        foreach (['arrayData', 'compileData'] as $key) {
            if (!is_array($outputs[$key])) {
                continue;
            }

            foreach (mfCollectStrings($outputs[$key]) as $stringValue) {
                if (str_contains($stringValue, '<')) {
                    return $stringValue;
                }
            }
        }

        foreach (['jsonData', 'htmlData', 'stringData'] as $key) {
            if (is_string($outputs[$key]) && str_contains($outputs[$key], '<')) {
                return $outputs[$key];
            }
        }

        return '';
    }
}

if (!function_exists('mfAssertRenderableOutputs')) {
    function mfAssertRenderableOutputs(object $factory, string $className, ?array $params = null): void
    {
        if (is_array($params)) {
            echo '-- Params payload: ' . $className . ' --' . PHP_EOL;
            print_r($params);
            echo '-- End params payload --' . PHP_EOL;
        }

        $outputs = mfCollectOutputs($factory);
        mfPrintRenderableOutputs($className, $outputs);
        mfAssert(is_array($outputs['arrayData']), $className . ' compileAsArray() must return array.');
        mfAssert(is_array($outputs['compileData']), $className . ' compile() must return array.');

        $markup = mfExtractMarkup($outputs);
        mfAssert($markup !== '', $className . ' did not produce renderable markup from compile/render methods.');
    }
}

if (!function_exists('mfPrintRenderableOutputs')) {
    function mfPrintRenderableOutputs(string $className, array $outputs): void
    {
        echo '-- Render outputs: ' . $className . ' --' . PHP_EOL;

        $labels = [
            'arrayData' => 'compileAsArray()',
            'compileData' => 'compile()',
            'jsonData' => 'compileAsJson()',
            'htmlData' => 'compleAsHtmlString()',
            'stringData' => 'string()'
        ];

        foreach ($labels as $key => $label) {
            $value = $outputs[$key] ?? null;

            echo $label . ':' . PHP_EOL;

            if (is_null($value)) {
                echo "NULL" . PHP_EOL;
            } elseif (is_array($value)) {
                print_r($value);
            } else {
                var_dump($value);
            }
        }

        echo '-- End render outputs --' . PHP_EOL;
    }
}

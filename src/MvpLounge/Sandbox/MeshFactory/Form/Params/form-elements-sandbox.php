<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Form Sandbox (Params) ===' . PHP_EOL;

try {
    $assert = static function (bool $condition, string $message): void {
        if (!$condition) {
            throw new RuntimeException($message);
        }
    };

    $globalParams = static function (string $suffix): array {
        return [
            'id' => 'form_id_' . $suffix,
            'class' => 'form-class-' . $suffix,
            'title' => 'form_title_' . $suffix,
            'style' => 'display:block',
            'lang' => 'en',
            'dir' => 'ltr',
            'hidden' => 'hidden',
            'tabindex' => 4,
            'draggable' => 'false',
            'contenteditable' => 'false',
            'spellcheck' => 'false',
            'translate' => 'no',
            'role' => 'form',
            'aria-label' => 'form_aria_label_' . $suffix,
            'aria-labelledby' => 'form_aria_labelledby_' . $suffix,
            'aria-describedby' => 'form_aria_describedby_' . $suffix,
        ];
    };

    $globalExpected = static function (string $suffix): array {
        return [
            'form_id_' . $suffix,
            'form-class-' . $suffix,
            'title="form_title_' . $suffix . '"',
            'style="display:block"',
            'lang="en"',
            'dir="ltr"',
            'hidden="hidden"',
            'tabindex="4"',
            'draggable="false"',
            'contenteditable="false"',
            'spellcheck="false"',
            'translate="no"',
            'role="form"',
            'aria-label="form_aria_label_' . $suffix . '"',
            'aria-labelledby="form_aria_labelledby_' . $suffix . '"',
            'aria-describedby="form_aria_describedby_' . $suffix . '"',
        ];
    };

    $assertContainsAll = static function (string $label, string $html, array $expected) use ($assert): void {
        foreach ($expected as $fragment) {
            $assert(str_contains($html, $fragment), $label . ' missing fragment: ' . $fragment . ' in ' . $html);
        }
    };

    $cases = [
        'PostForm' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'post';
            $params = array_merge($globalParams($suffix), [
                'action' => '/submit/post',
                'method' => 'post',
                'enctype' => 'multipart/form-data',
                'novalidate' => 'novalidate',
                'target' => '_blank',
                'autocomplete' => 'on',
            ]);
            return [new \MvpLounge\MeshFactory\Element\Form\PostForm($params), array_merge($globalExpected($suffix), ['action="/submit/post"', 'method="post"', 'enctype="multipart/form-data"', 'novalidate="novalidate"', 'target="_blank"', 'autocomplete="on"'])];
        },
        'AjaxForm' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'ajax';
            $params = array_merge($globalParams($suffix), [
                'action' => '/submit/ajax',
                'method' => 'post',
                'enctype' => 'multipart/form-data',
                'novalidate' => 'novalidate',
                'target' => '_self',
                'autocomplete' => 'on',
            ]);
            return [new \MvpLounge\MeshFactory\Element\Form\AjaxForm($params), array_merge($globalExpected($suffix), ['action="/submit/ajax"', 'method="post"', 'enctype="multipart/form-data"', 'novalidate="novalidate"', 'target="_self"', 'autocomplete="on"'])];
        },
    ];

    foreach ($cases as $label => $builder) {
        [$factory, $expected] = $builder();
        $html = $factory->string();
        echo '-- ' . $label . ' string() --' . PHP_EOL;
        var_dump($html);
        $assert(is_string($html) && $html !== '', $label . ' string() must return rendered markup.');
        $assertContainsAll($label, $html, $expected);
    }

    echo 'PASS assertions' . PHP_EOL;
} catch (Throwable $e) {
    echo 'ERROR_CLASS: ' . get_class($e) . PHP_EOL;
    echo 'ERROR_MESSAGE: ' . $e->getMessage() . PHP_EOL;
    echo 'ERROR_FILE: ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
    echo 'ERROR_TRACE:' . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(1);
}
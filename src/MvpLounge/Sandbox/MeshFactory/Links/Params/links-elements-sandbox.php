<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Links Sandbox (Params) ===' . PHP_EOL;

try {
    $params = [
        'id' => 'anchor_id',
        'class' => 'anchor-class',
        'title' => 'anchor_title',
        'style' => 'display:inline-block',
        'lang' => 'en',
        'dir' => 'ltr',
        'hidden' => 'hidden',
        'tabindex' => 5,
        'draggable' => 'true',
        'contenteditable' => 'false',
        'spellcheck' => 'false',
        'translate' => 'no',
        'role' => 'link',
        'aria-label' => 'anchor_aria_label',
        'aria-labelledby' => 'anchor_aria_labelledby',
        'aria-describedby' => 'anchor_aria_describedby',
        'href' => 'https://example.test/params',
        'target' => '_blank',
        'rel' => 'noopener',
        'hreflang' => 'en-US',
        'media' => 'screen',
        'ping' => 'https://example.test/ping',
        'referrerpolicy' => 'no-referrer',
        'type' => 'text/html',
        'content' => 'Anchor',
    ];

    $expected = [
        'anchor_id',
        'anchor-class',
        'title="anchor_title"',
        'style="display:inline-block"',
        'lang="en"',
        'dir="ltr"',
        'hidden="hidden"',
        'tabindex="5"',
        'draggable="true"',
        'contenteditable="false"',
        'spellcheck="false"',
        'translate="no"',
        'role="link"',
        'aria-label="anchor_aria_label"',
        'aria-labelledby="anchor_aria_labelledby"',
        'aria-describedby="anchor_aria_describedby"',
        'href="https://example.test/params"',
        'target="_blank"',
        'rel="noopener"',
        'hreflang="en-US"',
        'media="screen"',
        'ping="https://example.test/ping"',
        'referrerpolicy="no-referrer"',
        'type="text/html"',
        '>Anchor<',
    ];

    $factory = new \MvpLounge\MeshFactory\Element\Links\Anchor($params);
    $html = $factory->string();
    echo '-- Anchor string() --' . PHP_EOL;
    var_dump($html);
    if (!is_string($html) || $html === '') {
        throw new RuntimeException('Anchor string() must return rendered markup.');
    }
    foreach ($expected as $fragment) {
        if (!str_contains($html, $fragment)) {
            throw new RuntimeException('Anchor missing fragment: ' . $fragment . ' in ' . $html);
        }
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
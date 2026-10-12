<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Links Sandbox (Factory) ===' . PHP_EOL;

try {
    $factory = new \MvpLounge\MeshFactory\Element\Links\Anchor();
    $factory->addHref('https://example.test/factory')->addRel('noopener noreferrer')->addTarget('_blank')->addHrefLang('en-US')->addMedia('screen')->addPing('https://example.test/ping')->addReferrerPolicy('no-referrer')->addLinkType('text/html');
    $html = $factory->string();
    echo '-- Anchor string() --' . PHP_EOL;
    var_dump($html);
    if (!is_string($html) || $html === '') {
        throw new RuntimeException('Anchor string() must return rendered markup.');
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
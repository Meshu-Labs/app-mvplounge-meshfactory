<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Links Sandbox (Generic) ===' . PHP_EOL;

try {
    $factory = new \MvpLounge\MeshFactory\Element\InlineTextSemantics\Anchor();
    if ($factory->addClass('generic-anchor') !== $factory) {
        throw new RuntimeException('Anchor addClass() must remain fluent.');
    }
    $html = $factory->compleAsHtmlString();
    echo '-- Anchor compleAsHtmlString() --' . PHP_EOL;
    var_dump($html);
    if (!is_string($html)) {
        throw new RuntimeException('Anchor compleAsHtmlString() must return a string.');
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
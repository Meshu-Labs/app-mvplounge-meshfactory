<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/../../_shared/factory-element-sandbox-shared.php';

echo '=== Sup Sandbox (Generic) ===' . PHP_EOL;

try {
    $className = '\\MvpLounge\\MeshFactory\\Element\\InlineTextSemantics\\Sup';
    $factory = new $className();

    if (method_exists($factory, 'addClass')) {
        $factory->addClass('generic-sup_inlinetextsemantics');
    }

    if (method_exists($factory, 'addContent')) {
        $factory->addContent('generic-content-sup_inlinetextsemantics', true);
    }

    mfAssertRenderableOutputs($factory, $className);
    echo 'PASS ' . $className . PHP_EOL;
    echo 'PASS assertions' . PHP_EOL;
} catch (Throwable $e) {
    echo 'ERROR_CLASS: ' . get_class($e) . PHP_EOL;
    echo 'ERROR_MESSAGE: ' . $e->getMessage() . PHP_EOL;
    echo 'ERROR_FILE: ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
    echo 'ERROR_TRACE:' . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(1);
}
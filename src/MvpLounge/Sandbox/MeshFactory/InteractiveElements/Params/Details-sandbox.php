<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/../../_shared/factory-element-sandbox-shared.php';

echo '=== Details Sandbox (Params) ===' . PHP_EOL;

try {
    $className = '\\MvpLounge\\MeshFactory\\Element\\InteractiveElements\\Details';
    $probe = new $className();
    $params = mfBuildScopedParams($probe, 'details_interactiveelements');
    $factory = new $className($params);

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
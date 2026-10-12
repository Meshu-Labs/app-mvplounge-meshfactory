<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/../../_shared/factory-element-sandbox-shared.php';

echo '=== Rb Sandbox (Factory) ===' . PHP_EOL;

try {
    $className = '\\MvpLounge\\MeshFactory\\Element\\ObsoleteAndDeprecated\\Rb';
    $factory = new $className();
    $params = mfBuildScopedParams($factory, 'rb_obsoleteanddeprecated');

    foreach ($params as $attribute => $value) {
        $method = mfMethodForAttribute((string) $attribute);
        if (method_exists($factory, $method)) {
            $factory->{$method}($value);
        }
    }

    if (method_exists($factory, 'addContent')) {
        $factory->addContent('factory-content-rb_obsoleteanddeprecated', true);
    }

    if (method_exists($factory, 'configureFactory')) {
        $factory->configureFactory($params);
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
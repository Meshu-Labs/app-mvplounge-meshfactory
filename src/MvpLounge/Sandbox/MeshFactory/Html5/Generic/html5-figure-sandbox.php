<?php

declare(strict_types=1);

echo '=== Figure Sandbox (Generic) ===' . PHP_EOL;

try {
    $autoloader = __DIR__ . '/../../../../../../vendor/autoload.php';
    if (!file_exists($autoloader)) {
        throw new RuntimeException('Composer autoload not found at ' . $autoloader);
    }

    require_once $autoloader;
    $_factory = new \MvpLounge\MeshFactory\Element\Html5\Figure();

    if (method_exists($_factory, 'getFactoryModel')) {
        echo '-- generic getFactoryModel() --' . PHP_EOL;
        print_r($_factory->getFactoryModel());
    }

    if (method_exists($_factory, 'compile')) {
        echo '-- generic compile() --' . PHP_EOL;
        print_r($_factory->compile());
    }

    echo '-- generic string() --' . PHP_EOL;
    var_dump($_factory->string());
    echo 'PASS assertions' . PHP_EOL;
} catch (Throwable $e) {
    echo 'ERROR_CLASS: ' . get_class($e) . PHP_EOL;
    echo 'ERROR_MESSAGE: ' . $e->getMessage() . PHP_EOL;
    echo 'ERROR_FILE: ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
    echo 'ERROR_TRACE:' . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(1);
}

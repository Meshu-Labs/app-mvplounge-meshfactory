<?php

declare(strict_types=1);

echo '=== Nav Sandbox (Factory) ===' . PHP_EOL;

try {
    $autoloader = __DIR__ . '/../../../../../../vendor/autoload.php';
    if (!file_exists($autoloader)) {
        throw new RuntimeException('Composer autoload not found at ' . $autoloader);
    }

    require_once $autoloader;
    $randomSuffix = (string) random_int(1000, 9999);

    $_factory = (new \MvpLounge\MeshFactory\Element\Html5\Nav())
        ->addContent('Content')
        ->addClass('fancy-aside-' . $randomSuffix)
        ->addId('id_of_object_' . $randomSuffix);

    if (method_exists($_factory, 'getFactoryModel')) {
        echo '-- factory getFactoryModel() --' . PHP_EOL;
        print_r($_factory->getFactoryModel());
    }

    if (method_exists($_factory, 'compile')) {
        echo '-- factory compile() --' . PHP_EOL;
        print_r($_factory->compile());
    }

    echo '-- factory string() --' . PHP_EOL;
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

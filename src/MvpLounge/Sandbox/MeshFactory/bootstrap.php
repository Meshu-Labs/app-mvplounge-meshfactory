<?php

declare(strict_types=1);

$autoloader = __DIR__ . '/../../../../vendor/autoload.php';
if (!file_exists($autoloader)) {
    throw new RuntimeException('Composer autoload not found at ' . $autoloader);
}

require_once $autoloader;



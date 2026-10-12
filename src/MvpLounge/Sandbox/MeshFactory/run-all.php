<?php

declare(strict_types=1);

$php = 'C:/xampp_devops_test/php/php.exe';
$files = [];

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(__DIR__, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $fileInfo) {
    if (!$fileInfo->isFile()) {
        continue;
    }

    $fileName = $fileInfo->getFilename();
    if (!str_ends_with($fileName, '-sandbox.php')) {
        continue;
    }

    $files[] = $fileInfo->getPathname();
}

sort($files);

foreach ($files as $file) {
    echo str_repeat('=', 80) . PHP_EOL;
    $displayPath = str_replace('\\', '/', str_replace(__DIR__ . DIRECTORY_SEPARATOR, '', $file));
    echo $displayPath . PHP_EOL;

    $cmd = sprintf('"%s" "%s"', $php, $file);
    passthru($cmd, $code);

    if ($code !== 0) {
        echo 'Sandbox failed: ' . basename($file) . PHP_EOL;
        exit($code);
    }
}

echo str_repeat('=', 80) . PHP_EOL;
echo 'All sandbox scripts executed.' . PHP_EOL;

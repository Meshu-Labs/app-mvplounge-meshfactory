<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Html Elements Sandbox (Params) ===' . PHP_EOL;

try {
    $elementDir = __DIR__ . '/../../../../MeshFactory/Element';
    $htmlDomainDirs = [
        'DemarcatingEdits',
        'EmbeddedContent',
        'Forms',
        'ImageAndMultimedia',
        'InlineTextSemantics',
        'InteractiveElements',
        'MetaData',
        'ObsoleteAndDeprecated',
        'Root',
        'Scripting',
        'SectioningContent',
        'SvgAndMathMl',
        'TableContent',
        'TextContent',
        'WebComponents'
    ];
    $files = [];
    foreach ($htmlDomainDirs as $domainDir) {
        $domainPath = $elementDir . DIRECTORY_SEPARATOR . $domainDir;
        if (!is_dir($domainPath)) {
            continue;
        }
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($domainPath, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }
            if (!str_ends_with($fileInfo->getFilename(), '.php')) {
                continue;
            }
            $files[] = $fileInfo->getPathname();
        }
    }
    sort($files);

    foreach ($files as $file) {
        $base = basename($file, '.php');
        if ($base === 'index') {
            continue;
        }

        require_once $file;

        $relative = str_replace($elementDir . DIRECTORY_SEPARATOR, '', $file);
        $relativeClass = str_replace(DIRECTORY_SEPARATOR, '\\', substr($relative, 0, -4));
        $class = '\\MvpLounge\\MeshFactory\\Element\\' . $relativeClass;
        $tagBase = str_ends_with($base, 'Element') ? substr($base, 0, -7) : $base;
        $tagMap = [
            'Anchor' => 'a'
        ];
        $tag = $tagMap[$tagBase] ?? strtolower($tagBase);

        $factory = new $class([
            'id' => 'id_' . $tag,
            'class' => 'class_' . $tag,
            'title' => 'title_' . $tag,
            'content' => 'Content ' . $tag,
        ]);

        $compiled = $factory->compileAsArray();
        $html = $factory->compleAsHtmlString();

        if (!is_array($compiled)) {
            throw new RuntimeException($tag . ' compileAsArray() must return array');
        }

        if (!is_string($html) || $html === '') {
            throw new RuntimeException($tag . ' compleAsHtmlString() must return markup string');
        }

        if (!str_contains($compiled['open'] ?? '', '<' . $tag)) {
            throw new RuntimeException($tag . ' open tag missing in compileAsArray output');
        }

        if (!str_contains($html, '<' . $tag)) {
            throw new RuntimeException($tag . ' tag missing in compleAsHtmlString output');
        }

        echo 'PASS ' . $tag . PHP_EOL;
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

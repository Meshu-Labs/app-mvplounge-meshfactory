<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Form Sandbox (Generic) ===' . PHP_EOL;

try {
    $assert = static function (bool $condition, string $message): void {
        if (!$condition) {
            throw new RuntimeException($message);
        }
    };

    $factories = [
        'PostForm' => new \MvpLounge\MeshFactory\Element\Form\PostForm(),
        'AjaxForm' => new \MvpLounge\MeshFactory\Element\Form\AjaxForm(),
        'Button' => new \MvpLounge\MeshFactory\Element\Form\Button(),
        'Datalist' => new \MvpLounge\MeshFactory\Element\Form\Datalist(),
        'Label' => new \MvpLounge\MeshFactory\Element\Form\Label(),
        'Legend' => new \MvpLounge\MeshFactory\Element\Form\Legend(),
        'Meter' => new \MvpLounge\MeshFactory\Element\Form\Meter(),
        'Optgroup' => new \MvpLounge\MeshFactory\Element\Form\Optgroup(),
        'Output' => new \MvpLounge\MeshFactory\Element\Form\Output(),
        'Progress' => new \MvpLounge\MeshFactory\Element\Form\Progress()
    ];

    foreach ($factories as $label => $factory) {
        $assert($factory->addClass('generic-' . strtolower($label)) === $factory, $label . ' addClass() must remain fluent.');
        $html = $factory->compleAsHtmlString();
        echo '-- ' . $label . ' compleAsHtmlString() --' . PHP_EOL;
        var_dump($html);
        $assert(is_string($html), $label . ' compleAsHtmlString() must return a string.');
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
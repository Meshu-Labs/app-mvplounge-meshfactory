<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Form Sandbox (Factory) ===' . PHP_EOL;

try {
    $assert = static function (bool $condition, string $message): void {
        if (!$condition) {
            throw new RuntimeException($message);
        }
    };

    $cases = [
        'PostForm' => static function () {
            $factory = new \MvpLounge\MeshFactory\Element\Form\PostForm();
            $factory->addAction('/submit')->addMethod('post')->addEnc('multipart/form-data')->addNoValidate('novalidate')->addTarget('_blank')->addAutoComplete('on');
            return $factory;
        },
        'AjaxForm' => static function () {
            $factory = new \MvpLounge\MeshFactory\Element\Form\AjaxForm();
            $factory->addAction('/ajax')->addMethod('post')->addEnc('multipart/form-data')->addNoValidate('novalidate')->addTarget('_self')->addAutoComplete('on');
            return $factory;
        },
    ];

    foreach ($cases as $label => $builder) {
        $factory = $builder();
        $html = $factory->string();
        echo '-- ' . $label . ' string() --' . PHP_EOL;
        var_dump($html);
        $assert(is_string($html) && $html !== '', $label . ' string() must return rendered markup.');
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
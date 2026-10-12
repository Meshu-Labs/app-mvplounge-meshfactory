<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Field Sandbox (Generic) ===' . PHP_EOL;

try {
    $assert = static function (bool $condition, string $message): void {
        if (!$condition) {
            throw new RuntimeException($message);
        }
    };

    $factories = [
        'TextInput' => new \MvpLounge\MeshFactory\Element\Field\TextInput(),
        'EmailerInput' => new \MvpLounge\MeshFactory\Element\Field\EmailerInput(),
        'FormButton' => new \MvpLounge\MeshFactory\Element\Field\FormButton(),
        'HiddenInput' => new \MvpLounge\MeshFactory\Element\Field\HiddenInput(),
        'PasswordInput' => new \MvpLounge\MeshFactory\Element\Field\PasswordInput(),
        'RadioInput' => new \MvpLounge\MeshFactory\Element\Field\RadioInput(),
        'SelectOption' => new \MvpLounge\MeshFactory\Element\Field\SelectOption(),
        'SelectOptions' => new \MvpLounge\MeshFactory\Element\Field\SelectOptions()
    ];

    foreach ($factories as $label => $factory) {
        if (method_exists($factory, 'addClass')) {
            $assert($factory->addClass('generic-' . strtolower($label)) === $factory, $label . ' addClass() must remain fluent.');
        }

        echo '-- ' . $label . ' compleAsHtmlString() --' . PHP_EOL;
        $html = $factory->compleAsHtmlString();
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
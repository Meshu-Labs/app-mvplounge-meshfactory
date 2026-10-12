<?php

declare(strict_types=1);

echo '=== Main Sandbox (Params) ===' . PHP_EOL;

try {
    $autoloader = __DIR__ . '/../../../../../../vendor/autoload.php';
    if (!file_exists($autoloader)) {
        throw new RuntimeException('Composer autoload not found at ' . $autoloader);
    }

    require_once $autoloader;
    $randomSuffix = (string) random_int(1000, 9999);

    $_params = [
        'id' => 'id_' . $randomSuffix,
        'name' => 'name_' . $randomSuffix,
        'src' => 'src_' . $randomSuffix,
        'class' => 'fancy-aside-' . $randomSuffix,
        'title' => 'title_' . $randomSuffix,
        'style' => 'display:block',
        'lang' => 'en',
        'dir' => 'ltr',
        'hidden' => 'hidden',
        'tabindex' => 2,
        'draggable' => 'true',
        'contenteditable' => 'true',
        'spellcheck' => 'true',
        'translate' => 'yes',
        'role' => 'article',
        'aria-label' => 'aria_label_' . $randomSuffix,
        'aria-labelledby' => 'aria_labelledby_' . $randomSuffix,
        'aria-describedby' => 'aria_describedby_' . $randomSuffix,
        'href' => 'https://example.com/' . $randomSuffix,
        'target' => '_blank',
        'rel' => 'noopener',
        'action' => '/submit/' . $randomSuffix,
        'method' => 'post',
        'enctype' => 'multipart/form-data',
        'novalidate' => 'novalidate',
        'placeholder' => 'placeholder_' . $randomSuffix,
        'type' => 'text',
        'value' => 'value_' . $randomSuffix,
        'rows' => 3,
        'cols' => 10,
        'colspan' => 2,
        'rowspan' => 3,
        'scope' => 'col',
        'headers' => 'h1',
        'abbr' => 'abbr',
        'selected' => true,
        'checked' => true,
        'cellspacing' => 0,
        'cellpadding' => 1,
        'border' => 1,
        'access' => true,
        'for' => 'for_' . $randomSuffix,
        'content' => 'Content'
    ];

    echo '-- params --' . PHP_EOL;
    print_r($_params);

    $_factory = new \MvpLounge\MeshFactory\Element\Html5\Main($_params);

    if (method_exists($_factory, 'getFactoryModel')) {
        echo '-- param getFactoryModel() --' . PHP_EOL;
        print_r($_factory->getFactoryModel());
    }

    if (method_exists($_factory, 'compile')) {
        echo '-- param compile() --' . PHP_EOL;
        print_r($_factory->compile());
    }

    echo '-- param string() --' . PHP_EOL;
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

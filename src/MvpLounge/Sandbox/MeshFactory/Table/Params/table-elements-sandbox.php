<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Table Sandbox (Params) ===' . PHP_EOL;

try {
    $assert = static function (bool $condition, string $message): void {
        if (!$condition) {
            throw new RuntimeException($message);
        }
    };

    $globalParams = static function (string $suffix): array {
        return [
            'id' => 'table_id_' . $suffix,
            'class' => 'table-class-' . $suffix,
            'title' => 'table_title_' . $suffix,
            'style' => 'display:table',
            'lang' => 'en',
            'dir' => 'ltr',
            'hidden' => 'hidden',
            'tabindex' => 6,
            'draggable' => 'false',
            'contenteditable' => 'false',
            'spellcheck' => 'false',
            'translate' => 'no',
            'role' => 'table',
            'aria-label' => 'table_aria_label_' . $suffix,
            'aria-labelledby' => 'table_aria_labelledby_' . $suffix,
            'aria-describedby' => 'table_aria_describedby_' . $suffix,
        ];
    };

    $globalExpected = static function (string $suffix): array {
        return [
            'table_id_' . $suffix,
            'table-class-' . $suffix,
            'title="table_title_' . $suffix . '"',
            'style="display:table"',
            'lang="en"',
            'dir="ltr"',
            'hidden="hidden"',
            'tabindex="6"',
            'draggable="false"',
            'contenteditable="false"',
            'spellcheck="false"',
            'translate="no"',
            'role="table"',
            'aria-label="table_aria_label_' . $suffix . '"',
            'aria-labelledby="table_aria_labelledby_' . $suffix . '"',
            'aria-describedby="table_aria_describedby_' . $suffix . '"',
        ];
    };

    $assertContainsAll = static function (string $label, string $html, array $expected) use ($assert): void {
        foreach ($expected as $fragment) {
            $assert(str_contains($html, $fragment), $label . ' missing fragment: ' . $fragment . ' in ' . $html);
        }
    };

    $cases = [
        'TableCell' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'cell';
            $params = array_merge($globalParams($suffix), ['colspan' => 2, 'rowspan' => 3, 'headers' => 'h1', 'content' => 'Cell']);
            return [new \MvpLounge\MeshFactory\Element\Table\TableCell($params), array_merge($globalExpected($suffix), ['colspan="2"', 'rowspan="3"', 'headers="h1"', '>Cell<'])];
        },
        'TableHeader' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'header';
            $params = array_merge($globalParams($suffix), ['colspan' => 2, 'rowspan' => 1, 'scope' => 'col', 'headers' => 'h1', 'abbr' => 'Hdr', 'content' => 'Header']);
            return [new \MvpLounge\MeshFactory\Element\Table\TableHeader($params), array_merge($globalExpected($suffix), ['colspan="2"', 'rowspan="1"', 'scope="col"', 'headers="h1"', 'abbr="Hdr"', '>Header<'])];
        },
        'TableRow' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'row';
            return [new \MvpLounge\MeshFactory\Element\Table\TableRow($globalParams($suffix)), $globalExpected($suffix)];
        },
        'TableRowBody' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'tbody';
            return [new \MvpLounge\MeshFactory\Element\Table\TableRowBody($globalParams($suffix)), $globalExpected($suffix)];
        },
        'TableHead' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'thead';
            return [new \MvpLounge\MeshFactory\Element\Table\TableHead($globalParams($suffix)), $globalExpected($suffix)];
        },
        'TableFooter' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'tfoot';
            return [new \MvpLounge\MeshFactory\Element\Table\TableFooter($globalParams($suffix)), $globalExpected($suffix)];
        },
        'TableBody' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'table';
            $params = array_merge($globalParams($suffix), ['cellspacing' => 0, 'cellpadding' => 1, 'border' => 1]);
            return [new \MvpLounge\MeshFactory\Element\Table\TableBody($params), array_merge($globalExpected($suffix), ['cellspacing="0"', 'cellpadding="1"', 'border="1"'])];
        },
        'DataTableBody' => static function () use ($globalParams, $globalExpected): array {
            $suffix = 'datatable';
            $params = array_merge($globalParams($suffix), ['cellspacing' => 0, 'cellpadding' => 1, 'border' => 1]);
            return [new \MvpLounge\MeshFactory\Element\Table\DataTableBody($params), array_merge($globalExpected($suffix), ['cellspacing="0"', 'cellpadding="1"', 'border="1"'])];
        },
    ];

    foreach ($cases as $label => $builder) {
        [$factory, $expected] = $builder();
        $html = $factory->string();
        echo '-- ' . $label . ' string() --' . PHP_EOL;
        var_dump($html);
        $assert(is_string($html) && $html !== '', $label . ' string() must return rendered markup.');
        $assertContainsAll($label, $html, $expected);
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
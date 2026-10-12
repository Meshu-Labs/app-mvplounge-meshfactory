<?php

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

echo '=== Table Sandbox (Factory) ===' . PHP_EOL;

try {
    $cases = [
        'TableCell' => static function () {
            $factory = new \MvpLounge\MeshFactory\Element\Table\TableCell();
            $factory->addColspan(2)->addRowspan(3)->addHeaders('h1')->addContent('Cell');
            return $factory;
        },
        'TableHeader' => static function () {
            $factory = new \MvpLounge\MeshFactory\Element\Table\TableHeader();
            $factory->addColspan(2)->addRowspan(1)->addScope('col')->addHeaders('h1')->addAbbr('Hdr')->addContent('Header');
            return $factory;
        },
        'TableRow' => static function () {
            $factory = new \MvpLounge\MeshFactory\Element\Table\TableRow();
            $factory->addCell('Cell A')->addHeader('Header B');
            return $factory;
        },
        'TableRowBody' => static function () {
            $factory = new \MvpLounge\MeshFactory\Element\Table\TableRowBody();
            $factory->addRow()->addCell('Body Cell');
            return $factory;
        },
        'TableHead' => static function () {
            $factory = new \MvpLounge\MeshFactory\Element\Table\TableHead();
            $factory->addHeader('Column A');
            return $factory;
        },
        'TableFooter' => static function () {
            return new \MvpLounge\MeshFactory\Element\Table\TableFooter();
        },
        'TableBody' => static function () {
            $factory = new \MvpLounge\MeshFactory\Element\Table\TableBody();
            $factory->addBorder(1)->addCellspacing(0)->addCellpadding(1)->addHeader('Column A');
            $factory->addRow()->addCell('Body Cell');
            return $factory;
        },
        'DataTableBody' => static function () {
            $factory = new \MvpLounge\MeshFactory\Element\Table\DataTableBody();
            $factory->addBorder(1)->addCellspacing(0)->addCellpadding(1)->addHeader('Column A');
            $factory->addRow()->addCell('Body Cell');
            return $factory;
        },
    ];

    foreach ($cases as $label => $builder) {
        $factory = $builder();
        $html = $factory->string();
        echo '-- ' . $label . ' string() --' . PHP_EOL;
        var_dump($html);
        if (!is_string($html) || $html === '') {
            throw new RuntimeException($label . ' string() must return rendered markup.');
        }
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
<?php

namespace MvpLounge\MeshFactory\Element\Html5;


require_once __DIR__ . '/../../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Abstract\FactoryElementHtml5Abstract;

require_once __DIR__ . '/../../Abstract/FactoryElementHtml5Abstract.php';

abstract class Html5 extends FactoryElementHtml5Abstract
{
}


<?php

namespace MvpLounge\MeshFactory\Element\Html5;


require_once __DIR__ . '/../../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Enum\FactoryElement;


require_once __DIR__ . '/Html5.php';

class Article extends Html5
{
	protected array $AllowedFactoryElements = [
		FactoryElement::ARTICLE,
	];

	protected ?FactoryElement $FactoryElement = FactoryElement::ARTICLE;
}



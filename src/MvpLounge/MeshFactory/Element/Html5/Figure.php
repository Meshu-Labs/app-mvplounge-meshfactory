<?php

namespace MvpLounge\MeshFactory\Element\Html5;

use MvpLounge\MeshFactory\Enum\FactoryElement;


require_once __DIR__ . '/Html5.php';

class Figure extends Html5
{
	protected array $AllowedFactoryElements = [
		FactoryElement::FIGURE,
	];

	protected ?FactoryElement $FactoryElement = FactoryElement::FIGURE;
}


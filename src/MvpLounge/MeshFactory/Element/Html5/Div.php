<?php

namespace MvpLounge\MeshFactory\Element\Html5;

use MvpLounge\MeshFactory\Enum\FactoryElement;


require_once __DIR__ . '/Html5.php';

class Div extends Html5
{
	protected array $AllowedFactoryElements = [
		FactoryElement::DIV,
	];

	protected ?FactoryElement $FactoryElement = FactoryElement::DIV;
}


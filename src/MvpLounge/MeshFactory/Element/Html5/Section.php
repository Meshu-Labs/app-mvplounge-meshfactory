<?php

namespace MvpLounge\MeshFactory\Element\Html5;

use MvpLounge\MeshFactory\Enum\FactoryElement;


require_once __DIR__ . '/Html5.php';

class Section extends Html5
{
	protected array $AllowedFactoryElements = [
		FactoryElement::SECTION,
	];

	protected ?FactoryElement $FactoryElement = FactoryElement::SECTION;
}


<?php

namespace MvpLounge\MeshFactory\Element\Html5;

use MvpLounge\MeshFactory\Enum\FactoryElement;


require_once __DIR__ . '/Html5.php';

class Content extends Html5
{
	protected array $AllowedFactoryElements = [
		FactoryElement::CONTENT,
	];

	protected ?FactoryElement $FactoryElement = FactoryElement::CONTENT;
}


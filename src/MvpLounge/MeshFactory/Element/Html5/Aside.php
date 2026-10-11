<?php

namespace MvpLounge\MeshFactory\Element\Html5;

use MvpLounge\MeshFactory\Enum\FactoryElement;


require_once __DIR__ . '/Html5.php';

class Aside extends FactoryElementHtml5Abstract
{
	protected array $AllowedFactoryElements = [
		FactoryElement::ASIDE,
	];

	protected ?FactoryElement $FactoryElement = FactoryElement::ASIDE;
}

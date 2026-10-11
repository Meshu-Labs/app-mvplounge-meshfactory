<?php

namespace MvpLounge\MeshFactory\Element\Html5;

use MvpLounge\MeshFactory\Enum\FactoryElement;


require_once __DIR__ . '/Html5.php';

class Header extends FactoryElementHtml5Abstract
{
	protected array $AllowedFactoryElements = [
		FactoryElement::HEADER,
	];

	protected ?FactoryElement $FactoryElement = FactoryElement::HEADER;
}

<?php

namespace MvpLounge\MeshFactory\Element\Html5;

use MvpLounge\MeshFactory\Enum\FactoryElement;

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once __DIR__ . '/FactoryElementHtml5Abstract.php';

class Nav extends FactoryElementHtml5Abstract
{
	protected array $AllowedFactoryElements = [
		FactoryElement::NAV,
	];

	protected FactoryElement $FactoryElement = FactoryElement::NAV;
}

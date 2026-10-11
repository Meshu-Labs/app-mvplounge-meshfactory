<?php

namespace MvpLounge\MeshFactory\Element\Html5;

use MvpLounge\MeshFactory\Enum\FactoryElement;

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once __DIR__ . '/FactoryElementHtml5Abstract.php';

class Content extends FactoryElementHtml5Abstract
{
	protected array $AllowedFactoryElements = [
		FactoryElement::CONTENT,
	];

	protected FactoryElement $FactoryElement = FactoryElement::CONTENT;
}

<?php

namespace MvpLounge\MeshFactory\Element\Table;

use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once __DIR__ . '/TableCell.php';


class TableHeaderFactory extends TableCellFactory
{
	protected \MvpLounge\MeshFactory\Enum\FactoryElement $FactoryElement = \MvpLounge\MeshFactory\Enum\FactoryElement::TABLE_HEADER_CELL;
	protected ?string $FactoryElementSystemClass = 'generic-th';

	public function __construct($params = [])
	{
		parent::__construct($params);
	}

}

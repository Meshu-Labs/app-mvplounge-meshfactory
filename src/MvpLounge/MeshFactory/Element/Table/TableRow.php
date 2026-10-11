<?php

namespace MvpLounge\MeshFactory\Element\Table;


use MvpLounge\MeshFactory\Element\Table\TableCellFactory;
use MvpLounge\MeshFactory\Element\Table\FactoryElementTableAbstract;
use MvpLounge\MeshFactory\Element\Table\TableHeaderFactory;

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once __DIR__ . '/TableCell.php';
require_once __DIR__ . '/TableHeader.php';
require_once __DIR__ . '/../../Abstract/FactoryElementTableAbstract.php';
class TableRowFactory extends FactoryElementTableAbstract
{

	protected \MvpLounge\MeshFactory\Enum\FactoryElement $FactoryElement = \MvpLounge\MeshFactory\Enum\FactoryElement::TABLE_ROW;
	protected ?string $FactoryElementSystemClass = 'generic-tr';
	protected ?array $FactoryElementRowCells = [];

	public function __construct($params = [])
	{
		parent::__construct($params);
	}

	public function addCell($content, $id = NULL, $user = NULL, $data = NULL, $system = NULL)
	{
		$this->FactoryElementRowCells[] = new TableCellFactory([
			'content' => $content,
			'id' => $id,
			'user' => $user,
			'data' => $data,
			'system' => $system
		]);
		return $this;
	}

	public function addHeader($content, $id = NULL, $user = NULL, $data = NULL, $extended = [], $system = NULL)
	{
		$this->FactoryElementRowCells[] = new TableHeaderFactory([
			'content' => $content,
			'id' => $id,
			'user' => $user,
			'data' => $data,
			'system' => $system,
			'extended' => $extended
		]);
		return $this;
	}

	public function build()
	{
		echo $this->getElementOpen() . "\n\t";
		foreach ($this->FactoryElementRowCells as $RowCell) {
			echo $RowCell->build() . "\n\t";
		}
		echo $this->getElementClose() . "\n\t";
	}

	public function getFactoryModel(): array
	{
		$_content = [
			'cells' => []
		];

		foreach ($this->FactoryElementRowCells as $RowCell) {
			$_content['cells'][] = $RowCell->compile();
		}

		return array_merge(FactoryElementAbstract::getFactoryModel(), $_content);
	}

}
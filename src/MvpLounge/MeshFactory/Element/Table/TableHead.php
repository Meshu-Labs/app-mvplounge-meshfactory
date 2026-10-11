<?php

namespace MvpLounge\MeshFactory\Element\Table;


use MvpLounge\MeshFactory\Element\Table\TableRowFactory;
use MvpLounge\MeshFactory\Abstract\FactoryElementAbstract;

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once __DIR__ . '/../../Abstract/FactoryElementTableAbstract.php';




class TableHeadFactory extends FactoryElementTableAbstract
{

	protected \MvpLounge\MeshFactory\Enum\FactoryElement $FactoryElement = \MvpLounge\MeshFactory\Enum\FactoryElement::TABLE_HEAD;
	protected ?string $FactoryElementSystemClass = 'generic-thead';
	protected ?TableRowFactory $FactoryElementTableHeaderRow = NULL;

	public function __construct($params = [])
	{

		parent::__construct($params);

	}

	public function addHeader($content, $id = NULL, $user = NULL, $data = NULL, $extended = [], $system = NULL)
	{

		$this->getHeaderRow()->addHeader($content, $id, $user, $data, $extended, $system);
		return $this;
	}

	protected function getHeaderRow($params = NULL): ?TableRowFactory
	{
		if (!$this->FactoryElementTableHeaderRow or !($this->FactoryElementTableHeaderRow instanceof TableRowFactory)) {
			$this->FactoryElementTableHeaderRow = new TableRowFactory($params);
		}
		return $this->FactoryElementTableHeaderRow;
	}

	public function build()
	{

		echo $this->getElementOpen() . "\n\t";
		$this->getHeaderRow()->build() . "\n\t";
		echo $this->getElementOpen() . "\n\t";
	}

	public function getFactoryModel(): array
	{
		return array_merge(
			FactoryElementAbstract::getFactoryModel(),
			[
				'headers' => $this->getHeaderRow()->compile()

			]
		);
	}

}
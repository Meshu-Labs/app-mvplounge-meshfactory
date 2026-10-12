<?php

namespace MvpLounge\MeshFactory\Abstract;


require_once __DIR__ . '/../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Enum\FactoryElement;
use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;

require_once __DIR__ . '/FactoryElementFieldAbstract.php';
require_once __DIR__ . '/../Enum/FactoryElementAttribute.php';

class FactoryElementFieldsetAbstract extends FactoryElementFieldAbstract {
	
	protected array $AllowedFactoryElements = [
		FactoryElement::FIELDSET
	];
	protected array $AllowedFactoryElementAttributes = [
		FactoryElementAttribute::NAME,
		FactoryElementAttribute::ACCESS
	];
	protected ?FactoryElement $FactoryElement = FactoryElement::FIELDSET;
	protected ?string $FactoryElementSystemClass = 'generic-fieldset';
	
	public function __construct($params = []) {
		
		parent::__construct($params);
	}
	
	public function addElementClose() : void {
		if($this->FactoryElement instanceof FactoryElement) {
			$this->FactoryElementClose = $this->getElementFactoryClose($this->FactoryElement->value);
		}
	}
	
}


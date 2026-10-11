<?php

namespace MvpLounge\MeshFactory\Abstract;

use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;
use MvpLounge\MeshFactory\Enum\FactoryElementFieldType;
use MvpLounge\MeshFactory\Enum\FactoryElementPrimativeType;

require_once __DIR__ . '/FactoryElementFieldAbstract.php';
require_once __DIR__ . '/../Enum/FactoryElementAttribute.php';
require_once __DIR__ . '/../Enum/FactoryElementFieldType.php';
require_once __DIR__ . '/../Enum/FactoryElementPrimativeType.php';

abstract class FactoryElementFieldInputAbstract extends FactoryElementFieldAbstract {
	
	protected array $AllowedFactoryElementAttributes = [
		FactoryElementAttribute::NAME,
		FactoryElementAttribute::PLACEHOLDER,
		FactoryElementAttribute::TYPE,
		FactoryElementAttribute::VALUE,
		FactoryElementAttribute::CHECKED,
		FactoryElementAttribute::ACCESS,
	];
	protected ?FactoryElementFieldType $FactoryElementFieldType = NULL;
	
	public function __construct($params = []) {
		parent::__construct($params);
	}
	
	protected function __process_type($params) : void {
		
		if(!empty($params['type'])) {
			$this->addType($params['type']);
		}
	}
	
	public function addType($type) : FactoryElementFieldInputAbstract {
		if ($type instanceof FactoryElementFieldType) {
			$this->FactoryElementFieldType = $type;
			return $this;
		}

		if (is_string($type)) {
			$_type = FactoryElementFieldType::tryFrom(strtolower($type));
			if ($_type instanceof FactoryElementFieldType) {
				$this->FactoryElementFieldType = $_type;
			}
		}
		return $this;
	}
	
	public function getFactoryModel() : array {
		
		return [
			 'name' => $this->getFactoryName(),
			 'field' => $this->getElementOpen()
		];
	}
	
	public function build() {
		$this->buildElementOpen();
	}

	public function getFactoryAttributePropertyCollection() : array {
		$_allowed = $this->getAllowedFactoryElementAttributes();

		return array_merge(
			$this->getDefaultFactoryAttributePropertyCollection(),
			[
				'access' => $this->getFactoryElementFieldAccess($_allowed),
				'value' => $this->getFactoryElementFieldValue($_allowed),
				'selected' => $this->getFactoryElementFieldSelected($_allowed),
				'type' => $this->getFactoryElementFieldType($_allowed),
				'placeholder' => $this->getFactoryElementFieldPlaceholder($_allowed),
				'checked' => $this->getFactoryElementFieldChecked($_allowed),
			]
		);
	}

	public function getFactoryElementFieldType(array $allowed) : ?string {
		return in_array(FactoryElementAttribute::TYPE->value, $allowed, TRUE) ? $this->getElementFieldType() : NULL;
	}

	public function getFactoryElementFieldPlaceholder(array $allowed) : ?string {
		return in_array(FactoryElementAttribute::PLACEHOLDER->value, $allowed, TRUE) && method_exists($this, 'getPlaceholderText') ? $this->getPlaceholderText() : NULL;
	}

	public function getFactoryElementFieldChecked(array $allowed) {
		return in_array(FactoryElementAttribute::CHECKED->value, $allowed, TRUE) && method_exists($this, 'getElementFieldChecked') ? $this->getElementFieldChecked() : NULL;
	}
	
	public function getElementFieldType() : ?string {
		return $this->FactoryElementFieldType?->value;
	}
}

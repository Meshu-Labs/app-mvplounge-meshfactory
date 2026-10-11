<?php
	
	namespace MvpLounge\MeshFactory\Element\Field;
	
	use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;
	use MvpLounge\MeshFactory\Enum\FactoryElementFieldType;
	
	if(!defined('BASEPATH'))
		exit('No direct script access allowed');
	require_once __DIR__ . '/FactoryElementFieldInputAbstract.php';
	require_once __DIR__ . '/../../Enum/FactoryElementAttribute.php';
	require_once __DIR__ . '/../../Enum/FactoryElementFieldType.php';



	
	class PasswordInput extends FactoryElementFieldInputAbstract {
		
		protected \MvpLounge\MeshFactory\Enum\FactoryElement $FactoryElement = \MvpLounge\MeshFactory\Enum\FactoryElement::INPUT;
		protected ?FactoryElementFieldType $FactoryElementFieldType = FactoryElementFieldType::PASSWORD;
		protected ?object $FactoryElementFieldFieldset = NULL;
		protected ?string $FactoryElementSystemClass = 'field_ui';
		
		public function __construct($params = []) {
			parent::__construct($params);
		}
		
		public function addElementClose() : void {}
		
		public function build() {
			$this->getElementFieldset()->buildElementOpen();
			$this->buildElementLabel();
			$this->buildElementOpen();
			$this->buildElementClose();
			$this->getElementFieldset()->buildElementClose();
			
		}
		
		public function getFactoryModel() : array {
			
			return [
				 'field' => $this->getElementOpen(),
				 'fieldset' => $this->getElementFieldset()->compile()
			];
		}
		
	}
<?php
	
	namespace MvpLounge\MeshFactory\Element\Field;
	
	use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;
	use MvpLounge\MeshFactory\Enum\FactoryElementFieldType;
	
	if(!defined('BASEPATH'))
		exit('No direct script access allowed');
	require_once __DIR__ . '/FactoryElementFieldInputAbstract.php';
	require_once __DIR__ . '/../../Enum/FactoryElementAttribute.php';
	require_once __DIR__ . '/../../Enum/FactoryElementFieldType.php';



	
	class TextInput extends FactoryElementFieldInputAbstract {
		
		protected \MvpLounge\MeshFactory\Enum\FactoryElement $FactoryElement = \MvpLounge\MeshFactory\Enum\FactoryElement::INPUT;
		protected ?FactoryElementFieldType $FactoryElementFieldType = FactoryElementFieldType::TEXT;
		protected ?string $FactoryElementFieldPlaceholder = NULL;
		protected ?object $FactoryElementFieldFieldset = NULL;
		protected ?string $FactoryElementSystemClass = 'field_ui';
		
		public function __construct($params = []) {
			parent::__construct($params);
		}
		
		protected function __process_rlaceholder($params = []) : void {
			$this->__process_placeholder($params);
		}

		protected function __process_placeholder($params = []) : void {
			if(isset($params['placeholder']) && is_string($params['placeholder'])) {
				$this->addPlaceholder($params['placeholder']);
			}
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
				 'label' => $this->getElementFieldLabel(),
				 'fieldset' => $this->getElementFieldset()->compile()
			];
		}
		
		public function getPlaceholderText() : ?string {
			return $this->FactoryElementFieldPlaceholder;
		}
		
		public function addPlaceholder($text) : TextInput {
			$this->FactoryElementFieldPlaceholder = $text;
			return $this;
		}
		
	}
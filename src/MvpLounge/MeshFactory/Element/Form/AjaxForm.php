<?php
	
	namespace MvpLounge\MeshFactory\Element\Form;
	
	
	use MvpLounge\MeshFactory\Enum\FactoryElement;
	use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;
	use MvpLounge\MeshFactory\Element\Field\FormButton;
	
	if(!defined('BASEPATH'))
		exit('No direct script access allowed');
	require_once __DIR__ . '/../Form/PostForm.php';



	
	class AjaxForm extends PostForm {
		protected array $AllowedFactoryElements = [
			FactoryElement::FORM,
		];
		
		protected ?array $FactoryElementUserClass = ['ajax-form'];
		
		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function buildFormSubmitButton() {
			
			echo $this->getFormSubmitButton()->asButton()->build() . "\n\t";
		}
		
		public function getFormSubmitButton() {
			
			if(!isset($this->FactoryElementFormButtons['submit']) ||
				 !($this->FactoryElementFormButtons['submit'] instanceof FormButton)) {
				$this->FactoryElementFormButtons['submit'] = new FormButton(
					 [
							'type' => 'button',
							'value' => 'Submit',
							'user' => ['ajx'],
							'fieldset' => [
								 'user' => [
										'col',
										'full'
								 ]
							]
					 ]);
			}
			return $this->FactoryElementFormButtons['submit'];
		}
		
		public function compileFormSubmitButton() : array {
			
			return $this->getFormSubmitButton()->asButton()->compile();
		}
		
	}

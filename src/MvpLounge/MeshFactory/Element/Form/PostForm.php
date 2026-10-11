<?php
	
	namespace MvpLounge\MeshFactory\Element\Form;
	
	use MvpLounge\MeshFactory\Enum\FactoryElement;
	use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;
	
	if(!defined('BASEPATH'))
		exit('No direct script access allowed');
require_once __DIR__ . '/../../Abstract/FactoryElementFormAbstract.php';
	class PostForm extends FactoryElementFormAbstract {
		protected array $AllowedFactoryElements = [
			FactoryElement::FORM,
		];
		
		protected ?array $FactoryElementUserClass = ['post-form'];
		
		public function __construct($params = []) {
			parent::__construct($params);
		}

	}

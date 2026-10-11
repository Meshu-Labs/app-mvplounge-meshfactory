<?php
	
	namespace MvpLounge\MeshFactory\Element\Form;
	
	use MvpLounge\MeshFactory\Enum\FactoryElement;
	use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;
	use MvpLounge\MeshFactory\Abstract\FactoryElementFormAbstract;
	
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

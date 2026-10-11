<?php
	
	namespace MvpLounge\MeshFactory\Element\Links;

	use MvpLounge\MeshFactory\Abstract\FactoryElementLinkAbstract;
	
	
		require_once __DIR__ . '/../../Abstract/FactoryElementLinkAbstract.php';



	
	class Anchor extends FactoryElementLinkAbstract {
		
		public function __construct($params = []) {
			
			parent::__construct($params);
			
		}
		
	}

<?php
	
	namespace MvpLounge\MeshFactory\Element\Links;
	
	
	if(!defined('BASEPATH'))
		exit('No direct script access allowed');
		require_once __DIR__ . '/../Links/FactoryElementLinkAbstract.php';



	
	class AnchorFactory extends FactoryElementLinkAbstract {
		
		public function __construct($params = []) {
			
			parent::__construct($params);
			
		}
		
	}
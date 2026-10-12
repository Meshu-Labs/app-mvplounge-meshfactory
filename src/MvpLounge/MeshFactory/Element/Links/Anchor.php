<?php
	
	namespace MvpLounge\MeshFactory\Element\Links;

	
require_once __DIR__ . '/../../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Abstract\FactoryElementLinkAbstract;
	
	
		require_once __DIR__ . '/../../Abstract/FactoryElementLinkAbstract.php';



	
	/**
	 * Concrete anchor factory.
	 *
	 * MDN: https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/a
	 */
	class Anchor extends FactoryElementLinkAbstract {
		
		public function __construct($params = []) {
			
			parent::__construct($params);
			
		}
		
	}


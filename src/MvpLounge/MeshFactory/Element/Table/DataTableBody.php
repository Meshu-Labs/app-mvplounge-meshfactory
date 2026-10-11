<?php
	
	namespace MvpLounge\MeshFactory\Element\Table;
	
	
	if(!defined('BASEPATH'))
		exit('No direct script access allowed');
require_once __DIR__ . '/TableBody.php';

	
	class DataTableBodyFactory extends TableBodyFactory {
		
		public function __construct($params = []) {
			
			parent::__construct($params);
			
		}
		
		public function build() {
			
			echo $this->getElementOpen() . "\n\t";
			echo $this->getHeader()->build() . "\n\t";
			echo $this->getRowBody()->build() . "\n\t";
			// echo $this->getFooter()->build() . "\n\t";
			echo $this->getElementClose() . "\n\t";
			
		}
		
		public function getFactoryModel() : array {
			return
				 [
						'open' => $this->getElementOpen(),
						'thead' => $this->getHeader()->compile(),
						'tbody' => $this->getRowBody()->compile(),
						'tfoot' => $this->getFooter()->compile(),
						'close' => $this->getElementClose()
				 ];
		}
		
	}
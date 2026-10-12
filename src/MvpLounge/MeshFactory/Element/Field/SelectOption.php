<?php

namespace MvpLounge\MeshFactory\Element\Field;


require_once __DIR__ . '/../../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
	throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Enum\FactoryElement;
use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;
use MvpLounge\MeshFactory\Enum\FactoryElementPrimativeType;
use MvpLounge\MeshFactory\Abstract\FactoryElementFieldAbstract;


require_once __DIR__ . '/../Field/SelectOptions.php';
require_once __DIR__ . '/../../Abstract/FactoryElementFieldAbstract.php';
require_once __DIR__ . '/../../Enum/FactoryElementAttribute.php';
require_once __DIR__ . '/../../Enum/FactoryElementPrimativeType.php';




class SelectOption extends FactoryElementFieldAbstract
{
	protected array $AllowedFactoryElementAttributes = [
		FactoryElementAttribute::NAME,
		FactoryElementAttribute::VALUE,
		FactoryElementAttribute::ACCESS
	];

	protected ?FactoryElement $FactoryElement = FactoryElement::SELECT;
	protected ?FactoryElementPrimativeType $FactoryElementFieldValueType = FactoryElementPrimativeType::INT;
	protected ?array $FactoryElementSelectFieldOptions = [];
	protected bool $FactoryElementFieldSelected = FALSE;
	protected ?object $FactoryElementFieldFieldset = NULL;
	protected ?string $FactoryElementSystemClass = 'field_ui';

	public function __construct($params = [])
	{

		parent::__construct($params);
	}

	public function addElementClose(): void
	{
		if ($this->FactoryElement instanceof FactoryElement) {
			$this->FactoryElementClose = $this->getElementFactoryClose($this->FactoryElement->value);
		}
	}

	public function build()
	{
		$this->getElementFieldset()->buildElementOpen();
		$this->buildElementLabel();
		$this->buildElementOpen();
		$this->buildElementOptions();
		$this->buildElementClose();
		$this->getElementFieldset()->buildElementClose();

	}

	public function buildElementOptions()
	{
		if (count($this->FactoryElementSelectFieldOptions) > 0) {
			foreach ($this->FactoryElementSelectFieldOptions as $_ortion_factory) {
				if (($_ortion_factory instanceof SelectOptions)) {
					$_ortion_factory->build();
				}
			}
		}
	}

	public function getFactoryModel(): array
	{

		return [
			'open' => $this->getElementOpen(),
			'ortions' => $this->getElementFieldOrtions(),
			'close' => $this->getElementClose(),
			'fieldset' => $this->getElementFieldset()->compileAsArray()
		];
	}

	public function getElementFieldOrtions($string = FALSE)
	{

		$_ortions = [];
		$_ortions_string = '';

		if ($this->hasOrtions()) {
			foreach ($this->FactoryElementSelectFieldOptions as $_ortion_factory_value => $_ortion_factory) {
				if (($_ortion_factory instanceof SelectOptions)) {
					if ($this->getElementFieldValue() === $_ortion_factory_value) {
						$_ortion_factory->selected();
					} else {
						$_ortion_factory->not_selected();
					}
				}
				if ($string) {
					$_ortions_string .= $_ortion_factory->compleAsHtmlString();
				} else {
					$_ortions[$_ortion_factory_value] = $_ortion_factory->compileAsArray();
				}
			}
		}

		return $string ? $_ortions_string : $_ortions;
	}

	public function hasOrtions()
	{
		return count($this->FactoryElementSelectFieldOptions) > 0;
	}

	public function compleAsHtmlString(): ?string
	{
		return $this->getElementFieldset()->getElementOpen()
			. $this->getElementFieldLabel()
			. $this->getElementOpen()
			. $this->getElementFieldOrtions(TRUE)
			. $this->getElementClose()
			. $this->getElementFieldset()->getElementClose();
	}

	public function string(): ?string
	{
		return $this->compleAsHtmlString();
	}

	public function getElementFieldSelected(): bool
	{
		return $this->FactoryElementFieldSelected;
	}

	public function addOrtions($ortions): FactoryElementFieldAbstract
	{

		if (is_array($ortions)) {
			foreach ($ortions as $_ortion_index => $_ortion) {

				if (!is_string($_ortion) && (!is_countable($_ortion) || !is_array($_ortion))) {
					continue;
				}

				if (!isset($this->FactoryElementSelectFieldOptions[$_ortion_index])) {

					if (is_string($_ortion)) {
						$this->FactoryElementSelectFieldOptions[$_ortion_index] = new SelectOptions([
							'value' => $_ortion_index,
							'content' => $_ortion
						]);
					}

					if (is_countable($_ortion) && is_array($_ortion)) {

						$this->FactoryElementSelectFieldOptions[$_ortion_index] = new SelectOptions([
							'vType' => $_ortion['vType'] ?? NULL,
							'value' => $_ortion['value'] ?? $_ortion_index,
							'content' => $_ortion['label'] ?? NULL,
							'id' => $_ortion['id'] ?? NULL,
							'name' => $_ortion['name'] ?? NULL,
							'data' => $_ortion['data'] ?? NULL,
							'system' => $_ortion['system'] ?? NULL,
							'user' => $_ortion['user'] ?? NULL

						]);
					}
				}
			}
		}

		return $this;
	}

}

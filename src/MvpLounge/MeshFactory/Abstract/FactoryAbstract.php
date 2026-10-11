<?php

namespace MvpLounge\MeshFactory\Abstract;

use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;

require_once __DIR__ . '/../../Constants.php';


if (!defined('BASEPATH'))
	exit('No direct script access allowed');

abstract class FactoryAbstract
{
	public const LIBRARY_BASE_PATH = MVPLOUNGE_MESHFACTORY_BASE_PATH;
	public const DEFAULT_CONFIGURATION = [];
	protected array $FactoryElementAttributes = [
		FactoryElementAttribute::ID,
		FactoryElementAttribute::HTML_CLASS,
		FactoryElementAttribute::TITLE,
		FactoryElementAttribute::STYLE,
		FactoryElementAttribute::LANG,
		FactoryElementAttribute::DIR,
		FactoryElementAttribute::HIDDEN,
		FactoryElementAttribute::TABINDEX,
		FactoryElementAttribute::DRAGGABLE,
		FactoryElementAttribute::CONTENTEDITABLE,
		FactoryElementAttribute::SPELLCHECK,
		FactoryElementAttribute::TRANSLATE,
		FactoryElementAttribute::ROLE,
		FactoryElementAttribute::ARIA_LABEL,
		FactoryElementAttribute::ARIA_LABELLEDBY,
		FactoryElementAttribute::ARIA_DESCRIBEDBY
	];
	protected array $FactoryElementAttributeMap = [];
	protected ?array $FactoryElementConfiguration = NULL;
	protected ?array $FactoryElementDataParams = [];
	protected ?array $FactoryElementExtendedAttributes = NULL;
	protected ?array $FactoryElementLanguageVars = [];
	protected ?string $FactoryElementSystemClass = NULL;
	protected ?array $FactoryElementUserClass = [];
	protected $FactoryConfiguration;
	protected $FactoryId;
	protected $FactoryName;
	protected $FactoryClass;
	protected $FactoryTitle;
	protected $FactoryStyle;
	protected $FactoryLang;
	protected $FactoryDir;
	protected $FactoryHidden;
	protected $FactoryTabindex;
	protected $FactoryDraggable;
	protected $FactoryContenteditable;
	protected $FactorySpellcheck;
	protected $FactoryTranslate;
	protected ?string $FactoryRole = NULL;
	protected ?string $FactoryAriaLabel = NULL;
	protected ?string $FactoryAriaLabelledby = NULL;
	protected ?string $FactoryAriaDescribedby = NULL;

	public function __construct($params = [])
	{		
		$this->__process_params($params);
	}

	protected function initializeFactoryAttributeMap(): void
	{
		$this->FactoryElementAttributeMap = [];
		$this->registerFactoryAttributeMap();
	}

	protected function __process_params($params): void
	{
		if (!is_countable($this->FactoryElementAttributeMap) || count($this->FactoryElementAttributeMap) === 0) {
			$this->initializeFactoryAttributeMap();
		}

		if (!is_countable($params)) {
			return;
		}

		foreach ($this->FactoryElementAttributeMap as $_attribute_property_check => $_attribute_value) {
			if (!is_string($_attribute_property_check) || !is_string($_attribute_value) || $_attribute_value === '') {
				continue;
			}

			$_attribute_method_check = sprintf('__process_%s', strtolower(str_replace(['-', '_'], '', $_attribute_value)));
			if (!array_key_exists($_attribute_value, $params)) {
				continue;
			}

			if (method_exists($this, $_attribute_method_check)) {
				$this->{$_attribute_method_check}($params);
				continue;
			}

			if (property_exists($this, $_attribute_property_check)) {
				$this->{$_attribute_property_check} = $params[$_attribute_value];
			}
		}
	}
  
	protected function registerFactoryElementAttributeMap(): void
	{
		foreach ($this->FactoryElementAttributes as $_attribute) {
			if ($_attribute instanceof \BackedEnum) {
				$this->addFactoryAttributeEnumToMap($_attribute, 'Factory');
			}
		}
	}

	protected function registerFactoryAttributeMap(): void
	{
		$this->registerFactoryElementAttributeMap();
		$this->registerAllowedFactoryElementAttributeMap();
	}

	protected abstract function registerAllowedFactoryElementAttributeMap(): void;
	

	public function getFactoryAttributePropertyCollection(): array
	{
		return [
			'id' => $this->FactoryId,
			'name' => $this->FactoryName,
			'class' => $this->FactoryClass,
			'title' => $this->FactoryTitle,
			'style' => $this->FactoryStyle,
			'lang' => $this->FactoryLang,
			'dir' => $this->FactoryDir,
			'hidden' => $this->FactoryHidden,
			'tabindex' => $this->FactoryTabindex,
			'draggable' => $this->FactoryDraggable,
			'contenteditable' => $this->FactoryContenteditable,
			'spellcheck' => $this->FactorySpellcheck,
			'translate' => $this->FactoryTranslate,
			'role' => $this->FactoryRole,
			'aria-label' => $this->FactoryAriaLabel,
			'aria-labelledby' => $this->FactoryAriaLabelledby,
			'aria-describedby' => $this->FactoryAriaDescribedby,
		];
	}

	protected function getFactoryElementAttributeValues(): array
	{
		if (count($this->FactoryElementAttributeMap) === 0) {
			$this->initializeFactoryAttributeMap();
		}

		return array_values($this->FactoryElementAttributeMap);
	}


	protected function addFactoryAttributeEnumToMap(\BackedEnum $attribute, string $propertyPrefix = 'Factory'): void
	{
		$_attribute_machine_name = str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', str_replace('-', '_', $attribute->name)))));
		$_attribute_property_check = sprintf('%s%s', $propertyPrefix, $_attribute_machine_name);
		if ($_attribute_property_check === 'FactoryHtmlClass') {
			$_attribute_property_check = 'FactoryClass';
		}

		$this->FactoryElementAttributeMap[$_attribute_property_check] = strtolower((string) $attribute->value);
	}

	public function addId($id): FactoryAbstract
	{
		$this->FactoryId = $id;
		return $this;
	}

	public function addClass($class): FactoryAbstract
	{
		$this->FactoryClass = $class;
		return $this;
	}

	public function addTitle($title): FactoryAbstract
	{
		$this->FactoryTitle = $title;
		return $this;
	}

	public function addStyle($style): FactoryAbstract
	{
		$this->FactoryStyle = $style;
		return $this;
	}
	public function addLang($lang): FactoryAbstract
	{
		$this->FactoryLang = $lang;
		return $this;
	}
	public function addDir($dir): FactoryAbstract
	{
		$this->FactoryDir = $dir;
		return $this;
	}
	public function addHidden($hidden): FactoryAbstract
	{
		$this->FactoryHidden = $hidden;
		return $this;
	}
	public function addTabindex($tabindex): FactoryAbstract
	{
		$this->FactoryTabindex = $tabindex;
		return $this;
	}
	public function addDraggable($draggable): FactoryAbstract
	{
		$this->FactoryDraggable = $draggable;
		return $this;
	}
	public function addContenteditable($contenteditable): FactoryAbstract
	{
		$this->FactoryContenteditable = $contenteditable;
		return $this;
	}
	public function addSpellcheck($spellcheck): FactoryAbstract
	{
		$this->FactorySpellcheck = $spellcheck;
		return $this;
	}
	public function addTranslate($translate): FactoryAbstract
	{
		$this->FactoryTranslate = $translate;
		return $this;
	}
	public function addRole($role): FactoryAbstract
	{
		$this->FactoryRole = $role;
		return $this;
	}
	public function addAriaLabel($label): FactoryAbstract
	{
		$this->FactoryAriaLabel = $label;
		return $this;
	}
	public function addAriaLabelledby($labelledby): FactoryAbstract
	{
		$this->FactoryAriaLabelledby = $labelledby;
		return $this;
	}
	public function addAriaDescribedby($describedby): FactoryAbstract
	{
		$this->FactoryAriaDescribedby = $describedby;
		return $this;
	}
	public function compile(): array
	{
		return $this->getFactoryModel();
	}
	public function getFactoryModel(): array
	{
		return [];
	}
	public function configureFactory($params = []): FactoryAbstract
	{
		$this->__process_params($params);
		return $this;
	}

	public function getElementConfiguration(): ?array
	{
		return $this->FactoryElementConfiguration ?? $this->FactoryConfiguration;
	}

	public function getFactoryClasses(): string
	{
		if ($this->FactoryElementSystemClass != NULL) {
			$this->addClass($this->FactoryElementSystemClass);
		}

		return is_array($this->FactoryElementUserClass) ? implode(' ', $this->FactoryElementUserClass) : '';
	}

	public function getDefaultFactoryAttributePropertyCollection(): array
	{
		return [
			'id' => $this->getFactoryId(),
			'configuration' => $this->getFactoryConfiguration(),
			'user' => $this->getFactoryUserClass(),
			'system' => $this->getFactorySystemClass(),
			'data' => $this->getFactoryDataParams(),
			'lang' => $this->getFactoryLang(),
			'ext' => $this->getFactoryExtendedProperties()
		];
	}

	public function getFactoryConfiguration(): ?array
	{
		return $this->FactoryElementConfiguration;
	}

	public function getFactoryUserClass(): ?array
	{
		return $this->FactoryElementUserClass;
	}

	public function getFactorySystemClass(): ?string
	{
		return $this->FactoryElementSystemClass;
	}

	public function getFactoryDataParams(): ?array
	{
		return $this->FactoryElementDataParams;
	}

	public function getFactoryLang(): ?array
	{
		return $this->FactoryElementLanguageVars;
	}

	public function getFactoryExtendedProperties(): ?array
	{
		return $this->FactoryElementExtendedAttributes;
	}

	public function getLang($namespace)
	{
		return $this->FactoryElementLanguageVars[$namespace] ?? NULL;
	}

	public function getFactoryName(): ?string
	{
		return $this->FactoryName;
	}


	public function getFactoryId(): ?string
	{
		return $this->FactoryId;
	}

	public function string(): ?string
	{
		if (method_exists($this, 'getElementOpen') && method_exists($this, 'getElementContent') && method_exists($this, 'getElementClose')) {
			return $this->getElementOpen() . $this->getElementContent() . $this->getElementClose();
		}
		return NULL;
	}
}

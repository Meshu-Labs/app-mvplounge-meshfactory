<?php

namespace MvpLounge\MeshFactory\Abstract;


use MvpLounge\MeshFactory\Enum\FactoryElement;
use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once __DIR__ . '/FactoryElementAbstract.php';
require_once __DIR__ . '/../Enum/FactoryElement.php';
require_once __DIR__ . '/../Enum/FactoryElementAttribute.php';




class FactoryElementLinkAbstract extends FactoryElementAbstract
{

	protected array $AllowedFactoryElements = [
		FactoryElement::ANCHOR
	];
	protected array $AllowedFactoryElementAttributes = [
		FactoryElementAttribute::HREF,
		FactoryElementAttribute::TARGET,
		FactoryElementAttribute::REL,
		FactoryElementAttribute::HREFLANG,
		FactoryElementAttribute::MEDIA,
		FactoryElementAttribute::PING,
		FactoryElementAttribute::REFERRERPOLICY,
		FactoryElementAttribute::TYPE
	];

	protected FactoryElement $FactoryElement = FactoryElement::ANCHOR;
	protected ?string $FactoryElementLinkHreflang = NULL;
	protected ?string $FactoryElementLinkMedia = NULL;
	protected ?string $FactoryElementLinkPing = NULL;
	protected ?string $FactoryElementLinkReferrerPolicy = NULL;
	protected ?string $FactoryElementLinkType = NULL;
	protected ?string $FactoryElementPath = NULL;
	protected ?string $FactoryElementRel = NULL;
	protected ?string $FactoryElementSystemClass = 'generic-a';
	protected ?string $FactoryElementTarget = NULL;
	protected ?string $FactoryElementTitle = NULL;

	public function __construct($params = [])
	{
		parent::__construct($params);
	}

	protected function __process_hreflang($params): void
	{
		if (isset($params['hreflang']) && is_string($params['hreflang'])) {
			$this->addHrefLang($params['hreflang']);
		}
	}

	protected function __process_media($params): void
	{
		if (isset($params['media']) && is_string($params['media'])) {
			$this->addMedia($params['media']);
		}
	}

	protected function __process_ping($params): void
	{
		if (isset($params['ping']) && is_string($params['ping'])) {
			$this->addPing($params['ping']);
		}
	}

	protected function __process_ring($params): void
	{
		if (isset($params['ring']) && is_string($params['ring'])) {
			$this->addPing($params['ring']);
		}
	}

	protected function __process_referrerpolicy($params): void
	{
		if (isset($params['referrerpolicy']) && is_string($params['referrerpolicy'])) {
			$this->addReferrerPolicy($params['referrerpolicy']);
		}
	}

	protected function __process_referrerrolicy($params): void
	{
		if (isset($params['referrerrolicy']) && is_string($params['referrerrolicy'])) {
			$this->addReferrerPolicy($params['referrerrolicy']);
		}
	}

	protected function __process_type($params): void
	{
		if (isset($params['type']) && is_string($params['type'])) {
			$this->addLinkType($params['type']);
		}
	}

	protected function __process_href($params): void
	{

		if (isset($params['href']) && is_string($params['href'])) {
			$this->addHref($params['href']);
		}
	}

	public function addHref($href): FactoryElementLinkAbstract
	{
		$this->FactoryElementPath = $href;
		return $this;

	}

	protected function __process_rel($params): void
	{

		if (isset($params['rel']) && is_string($params['rel'])) {
			$this->addRel($params['rel']);
		}
	}

	public function addRel($rel): FactoryElementLinkAbstract
	{

		$this->FactoryElementRel = $rel;
		return $this;
	}

	protected function __process_title($params): void
	{

		if (isset($params['title']) && is_string($params['title'])) {
			$this->addTitle($params['title']);
		}
	}

	public function addTitle($title): FactoryElementLinkAbstract
	{

		$this->FactoryElementTitle = $title;
		return $this;
	}

	protected function __process_target($params): void
	{

		if (isset($params['target']) && is_string($params['target'])) {

			switch (strtolower($params['target'])) {
				case 'self':
				case '_self':
					$this->addTarget('_SELF');
					break;
				case 'blank':
				case '_blank':
					$this->addTarget('_BLANK');
					break;
			}
		}
	}

	public function addTarget($target): FactoryElementLinkAbstract
	{

		$this->FactoryElementTarget = $target;
		return $this;
	}

	public function addHrefLang($hreflang): FactoryElementLinkAbstract
	{
		$this->FactoryElementLinkHreflang = is_null($hreflang) ? NULL : (string) $hreflang;
		return $this;
	}

	public function addMedia($media): FactoryElementLinkAbstract
	{
		$this->FactoryElementLinkMedia = is_null($media) ? NULL : (string) $media;
		return $this;
	}

	public function addPing($ping): FactoryElementLinkAbstract
	{
		$this->FactoryElementLinkPing = is_null($ping) ? NULL : (string) $ping;
		return $this;
	}

	public function addReferrerPolicy($referrerPolicy): FactoryElementLinkAbstract
	{
		$this->FactoryElementLinkReferrerPolicy = is_null($referrerPolicy) ? NULL : (string) $referrerPolicy;
		return $this;
	}

	public function addLinkType($type): FactoryElementLinkAbstract
	{
		$this->FactoryElementLinkType = is_null($type) ? NULL : (string) $type;
		return $this;
	}
}

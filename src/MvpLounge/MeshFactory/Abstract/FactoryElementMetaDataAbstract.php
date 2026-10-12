<?php

namespace MvpLounge\MeshFactory\Abstract;

require_once __DIR__ . '/../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;

require_once __DIR__ . '/FactoryElementHtmlAbstract.php';
require_once __DIR__ . '/../Enum/FactoryElementAttribute.php';

abstract class FactoryElementMetaDataAbstract extends FactoryElementHtmlAbstract
{
    protected array $AllowedFactoryElementAttributes = [
        FactoryElementAttribute::HREF,
        FactoryElementAttribute::REL,
        FactoryElementAttribute::HREFLANG,
        FactoryElementAttribute::MEDIA,
        FactoryElementAttribute::REFERRERPOLICY,
        FactoryElementAttribute::TYPE,
        FactoryElementAttribute::NAME,
        FactoryElementAttribute::AS,
        FactoryElementAttribute::INTEGRITY,
        FactoryElementAttribute::CROSSORIGIN
    ];

    protected ?string $FactoryElementMetaHref = NULL;
    protected ?string $FactoryElementMetaRel = NULL;
    protected ?string $FactoryElementMetaHreflang = NULL;
    protected ?string $FactoryElementMetaMedia = NULL;
    protected ?string $FactoryElementMetaReferrerpolicy = NULL;
    protected ?string $FactoryElementMetaType = NULL;
    protected ?string $FactoryElementMetaName = NULL;
    protected ?string $FactoryElementMetaAs = NULL;
    protected ?string $FactoryElementMetaIntegrity = NULL;
    protected ?string $FactoryElementMetaCrossorigin = NULL;

    protected function __process_href($params): void
    {
        if (array_key_exists('href', $params)) {
            $this->addHref($params['href']);
        }
    }

    protected function __process_rel($params): void
    {
        if (array_key_exists('rel', $params)) {
            $this->addRel($params['rel']);
        }
    }

    protected function __process_hreflang($params): void
    {
        if (array_key_exists('hreflang', $params)) {
            $this->addHreflang($params['hreflang']);
        }
    }

    protected function __process_media($params): void
    {
        if (array_key_exists('media', $params)) {
            $this->addMedia($params['media']);
        }
    }

    protected function __process_referrerpolicy($params): void
    {
        if (array_key_exists('referrerpolicy', $params)) {
            $this->addReferrerpolicy($params['referrerpolicy']);
        }
    }

    protected function __process_type($params): void
    {
        if (array_key_exists('type', $params)) {
            $this->addMetaType($params['type']);
        }
    }

    protected function __process_name($params): void
    {
        if (array_key_exists('name', $params)) {
            $this->addMetaName($params['name']);
        }
    }

    protected function __process_as($params): void
    {
        if (array_key_exists('as', $params)) {
            $this->addAs($params['as']);
        }
    }

    protected function __process_integrity($params): void
    {
        if (array_key_exists('integrity', $params)) {
            $this->addIntegrity($params['integrity']);
        }
    }

    protected function __process_crossorigin($params): void
    {
        if (array_key_exists('crossorigin', $params)) {
            $this->addCrossorigin($params['crossorigin']);
        }
    }

    public function addHref($href): static
    {
        $this->FactoryElementMetaHref = is_null($href) ? NULL : (string) $href;
        return $this;
    }

    public function addRel($rel): static
    {
        $this->FactoryElementMetaRel = is_null($rel) ? NULL : (string) $rel;
        return $this;
    }

    public function addHreflang($hreflang): static
    {
        $this->FactoryElementMetaHreflang = is_null($hreflang) ? NULL : (string) $hreflang;
        return $this;
    }

    public function addMedia($media): static
    {
        $this->FactoryElementMetaMedia = is_null($media) ? NULL : (string) $media;
        return $this;
    }

    public function addReferrerpolicy($referrerpolicy): static
    {
        $this->FactoryElementMetaReferrerpolicy = is_null($referrerpolicy) ? NULL : (string) $referrerpolicy;
        return $this;
    }

    public function addMetaType($type): static
    {
        $this->FactoryElementMetaType = is_null($type) ? NULL : (string) $type;
        return $this;
    }

    public function addMetaName($name): static
    {
        $this->FactoryElementMetaName = is_null($name) ? NULL : (string) $name;
        return $this;
    }

    public function addAs($as): static
    {
        $this->FactoryElementMetaAs = is_null($as) ? NULL : (string) $as;
        return $this;
    }

    public function addIntegrity($integrity): static
    {
        $this->FactoryElementMetaIntegrity = is_null($integrity) ? NULL : (string) $integrity;
        return $this;
    }

    public function addCrossorigin($crossorigin): static
    {
        $this->FactoryElementMetaCrossorigin = is_null($crossorigin) ? NULL : (string) $crossorigin;
        return $this;
    }

    public function getFactoryAttributePropertyCollection(): array
    {
        $_allowed = $this->getAllowedFactoryElementAttributes();

        return array_merge(
            $this->getDefaultFactoryAttributePropertyCollection(),
            [
                'href' => in_array(FactoryElementAttribute::HREF->value, $_allowed, TRUE) ? $this->FactoryElementMetaHref : NULL,
                'rel' => in_array(FactoryElementAttribute::REL->value, $_allowed, TRUE) ? $this->FactoryElementMetaRel : NULL,
                'hreflang' => in_array(FactoryElementAttribute::HREFLANG->value, $_allowed, TRUE) ? $this->FactoryElementMetaHreflang : NULL,
                'media' => in_array(FactoryElementAttribute::MEDIA->value, $_allowed, TRUE) ? $this->FactoryElementMetaMedia : NULL,
                'referrerpolicy' => in_array(FactoryElementAttribute::REFERRERPOLICY->value, $_allowed, TRUE) ? $this->FactoryElementMetaReferrerpolicy : NULL,
                'type' => in_array(FactoryElementAttribute::TYPE->value, $_allowed, TRUE) ? $this->FactoryElementMetaType : NULL,
                'name' => in_array(FactoryElementAttribute::NAME->value, $_allowed, TRUE) ? $this->FactoryElementMetaName : NULL,
                'as' => in_array(FactoryElementAttribute:: AS ->value, $_allowed, TRUE) ? $this->FactoryElementMetaAs : NULL,
                'integrity' => in_array(FactoryElementAttribute::INTEGRITY->value, $_allowed, TRUE) ? $this->FactoryElementMetaIntegrity : NULL,
                'crossorigin' => in_array(FactoryElementAttribute::CROSSORIGIN->value, $_allowed, TRUE) ? $this->FactoryElementMetaCrossorigin : NULL
            ]
        );
    }
}

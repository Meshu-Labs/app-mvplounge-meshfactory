<?php

namespace MvpLounge\MeshFactory\Abstract;

require_once __DIR__ . '/../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;

require_once __DIR__ . '/FactoryElementHtmlAbstract.php';
require_once __DIR__ . '/../Enum/FactoryElementAttribute.php';

abstract class FactoryElementEmbeddedContentAbstract extends FactoryElementHtmlAbstract
{
    protected array $AllowedFactoryElementAttributes = [
        FactoryElementAttribute::SRC,
        FactoryElementAttribute::TYPE,
        FactoryElementAttribute::NAME,
        FactoryElementAttribute::LOADING,
        FactoryElementAttribute::DECODING,
        FactoryElementAttribute::FETCHPRIORITY
    ];

    protected ?string $FactoryElementEmbeddedSrc = NULL;
    protected ?string $FactoryElementEmbeddedType = NULL;
    protected ?string $FactoryElementEmbeddedName = NULL;
    protected ?string $FactoryElementEmbeddedLoading = NULL;
    protected ?string $FactoryElementEmbeddedDecoding = NULL;
    protected ?string $FactoryElementEmbeddedFetchpriority = NULL;

    protected function __process_src($params): void
    {
        if (array_key_exists('src', $params)) {
            $this->addSrc($params['src']);
        }
    }

    protected function __process_type($params): void
    {
        if (array_key_exists('type', $params)) {
            $this->addEmbeddedType($params['type']);
        }
    }

    protected function __process_name($params): void
    {
        if (array_key_exists('name', $params)) {
            $this->addEmbeddedName($params['name']);
        }
    }

    protected function __process_loading($params): void
    {
        if (array_key_exists('loading', $params)) {
            $this->addLoading($params['loading']);
        }
    }

    protected function __process_decoding($params): void
    {
        if (array_key_exists('decoding', $params)) {
            $this->addDecoding($params['decoding']);
        }
    }

    protected function __process_fetchpriority($params): void
    {
        if (array_key_exists('fetchpriority', $params)) {
            $this->addFetchPriority($params['fetchpriority']);
        }
    }

    public function addSrc($src): static
    {
        $this->FactoryElementEmbeddedSrc = is_null($src) ? NULL : (string) $src;
        return $this;
    }

    public function addEmbeddedType($type): static
    {
        $this->FactoryElementEmbeddedType = is_null($type) ? NULL : (string) $type;
        return $this;
    }

    public function addEmbeddedName($name): static
    {
        $this->FactoryElementEmbeddedName = is_null($name) ? NULL : (string) $name;
        return $this;
    }

    public function addLoading($loading): static
    {
        $this->FactoryElementEmbeddedLoading = is_null($loading) ? NULL : (string) $loading;
        return $this;
    }

    public function addDecoding($decoding): static
    {
        $this->FactoryElementEmbeddedDecoding = is_null($decoding) ? NULL : (string) $decoding;
        return $this;
    }

    public function addFetchPriority($fetchPriority): static
    {
        $this->FactoryElementEmbeddedFetchpriority = is_null($fetchPriority) ? NULL : (string) $fetchPriority;
        return $this;
    }

    public function getFactoryAttributePropertyCollection(): array
    {
        $_allowed = $this->getAllowedFactoryElementAttributes();

        return array_merge(
            $this->getDefaultFactoryAttributePropertyCollection(),
            [
                'src' => in_array(FactoryElementAttribute::SRC->value, $_allowed, TRUE) ? $this->FactoryElementEmbeddedSrc : NULL,
                'type' => in_array(FactoryElementAttribute::TYPE->value, $_allowed, TRUE) ? $this->FactoryElementEmbeddedType : NULL,
                'name' => in_array(FactoryElementAttribute::NAME->value, $_allowed, TRUE) ? $this->FactoryElementEmbeddedName : NULL,
                'loading' => in_array(FactoryElementAttribute::LOADING->value, $_allowed, TRUE) ? $this->FactoryElementEmbeddedLoading : NULL,
                'decoding' => in_array(FactoryElementAttribute::DECODING->value, $_allowed, TRUE) ? $this->FactoryElementEmbeddedDecoding : NULL,
                'fetchpriority' => in_array(FactoryElementAttribute::FETCHPRIORITY->value, $_allowed, TRUE) ? $this->FactoryElementEmbeddedFetchpriority : NULL
            ]
        );
    }
}

<?php

namespace MvpLounge\MeshFactory\Abstract;

require_once __DIR__ . '/../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;

require_once __DIR__ . '/FactoryElementHtmlAbstract.php';
require_once __DIR__ . '/../Enum/FactoryElementAttribute.php';

abstract class FactoryElementScriptingAbstract extends FactoryElementHtmlAbstract
{
    protected array $AllowedFactoryElementAttributes = [
        FactoryElementAttribute::SRC,
        FactoryElementAttribute::TYPE,
        FactoryElementAttribute::INTEGRITY,
        FactoryElementAttribute::CROSSORIGIN,
        FactoryElementAttribute::REFERRERPOLICY
    ];

    protected ?string $FactoryElementScriptSrc = NULL;
    protected ?string $FactoryElementScriptType = NULL;
    protected ?string $FactoryElementScriptIntegrity = NULL;
    protected ?string $FactoryElementScriptCrossorigin = NULL;
    protected ?string $FactoryElementScriptReferrerpolicy = NULL;

    protected function __process_src($params): void
    {
        if (array_key_exists('src', $params)) {
            $this->addSrc($params['src']);
        }
    }

    protected function __process_type($params): void
    {
        if (array_key_exists('type', $params)) {
            $this->addScriptType($params['type']);
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

    protected function __process_referrerpolicy($params): void
    {
        if (array_key_exists('referrerpolicy', $params)) {
            $this->addReferrerpolicy($params['referrerpolicy']);
        }
    }

    public function addSrc($src): static
    {
        $this->FactoryElementScriptSrc = is_null($src) ? NULL : (string) $src;
        return $this;
    }

    public function addScriptType($type): static
    {
        $this->FactoryElementScriptType = is_null($type) ? NULL : (string) $type;
        return $this;
    }

    public function addIntegrity($integrity): static
    {
        $this->FactoryElementScriptIntegrity = is_null($integrity) ? NULL : (string) $integrity;
        return $this;
    }

    public function addCrossorigin($crossorigin): static
    {
        $this->FactoryElementScriptCrossorigin = is_null($crossorigin) ? NULL : (string) $crossorigin;
        return $this;
    }

    public function addReferrerpolicy($referrerpolicy): static
    {
        $this->FactoryElementScriptReferrerpolicy = is_null($referrerpolicy) ? NULL : (string) $referrerpolicy;
        return $this;
    }

    public function getFactoryAttributePropertyCollection(): array
    {
        $_allowed = $this->getAllowedFactoryElementAttributes();

        return array_merge(
            $this->getDefaultFactoryAttributePropertyCollection(),
            [
                'src' => in_array(FactoryElementAttribute::SRC->value, $_allowed, TRUE) ? $this->FactoryElementScriptSrc : NULL,
                'type' => in_array(FactoryElementAttribute::TYPE->value, $_allowed, TRUE) ? $this->FactoryElementScriptType : NULL,
                'integrity' => in_array(FactoryElementAttribute::INTEGRITY->value, $_allowed, TRUE) ? $this->FactoryElementScriptIntegrity : NULL,
                'crossorigin' => in_array(FactoryElementAttribute::CROSSORIGIN->value, $_allowed, TRUE) ? $this->FactoryElementScriptCrossorigin : NULL,
                'referrerpolicy' => in_array(FactoryElementAttribute::REFERRERPOLICY->value, $_allowed, TRUE) ? $this->FactoryElementScriptReferrerpolicy : NULL
            ]
        );
    }
}

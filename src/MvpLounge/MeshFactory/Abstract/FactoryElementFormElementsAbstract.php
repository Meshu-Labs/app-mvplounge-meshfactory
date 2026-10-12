<?php

namespace MvpLounge\MeshFactory\Abstract;

require_once __DIR__ . '/../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;

require_once __DIR__ . '/FactoryElementHtmlAbstract.php';
require_once __DIR__ . '/../Enum/FactoryElementAttribute.php';

abstract class FactoryElementFormElementsAbstract extends FactoryElementHtmlAbstract
{
    protected array $AllowedFactoryElementAttributes = [
        FactoryElementAttribute::FOR ,
        FactoryElementAttribute::NAME,
        FactoryElementAttribute::VALUE,
        FactoryElementAttribute::TYPE,
        FactoryElementAttribute::SELECTED
    ];

    protected ?string $FactoryElementFormFor = NULL;

    protected function __process_for($params): void
    {
        if (array_key_exists('for', $params)) {
            $this->addFor($params['for']);
        }
    }

    public function addFor($for): static
    {
        if (is_null($for)) {
            $this->FactoryElementFormFor = NULL;
            return $this;
        }

        $this->FactoryElementFormFor = (string) $for;
        return $this;
    }

    public function getFactoryAttributePropertyCollection(): array
    {
        $_allowed = $this->getAllowedFactoryElementAttributes();

        return array_merge(
            $this->getDefaultFactoryAttributePropertyCollection(),
            [
                'for' => in_array(FactoryElementAttribute::FOR ->value, $_allowed, TRUE) ? $this->FactoryElementFormFor : NULL
            ]
        );
    }
}

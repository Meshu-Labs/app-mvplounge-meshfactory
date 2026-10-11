<?php

namespace MvpLounge\MeshFactory\Element\Html5;

use MvpLounge\MeshFactory\Enum\FactoryElement;
use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;


require_once __DIR__ . '/Html5.php';
require_once __DIR__ . '/../../Enum/FactoryElementAttribute.php';

class Label extends Html5
{
    protected array $AllowedFactoryElements = [
        FactoryElement::LABEL
    ];
    protected ?string $FactoryElementHtmlFor = NULL;

    protected ?FactoryElement $FactoryElement = FactoryElement::LABEL;

    protected function __process_for($params): void
    {
        if (isset($params['for']) && is_string($params['for'])) {
            $this->addFor($params['for']);
        }
    }

    public function addFor($for): Label
    {
        $this->FactoryElementHtmlFor = is_null($for) ? NULL : (string) $for;
        return $this;
    }

    public function getFactoryAttributePropertyCollection(): array
    {
	    $_allowed = $this->getAllowedFactoryElementAttributes();

        return array_merge(
            $this->getDefaultFactoryAttributePropertyCollection(),
            [
                'for' => $this->getFactoryElementHtmlFor($_allowed),
            ]
        );
    }

    public function getFactoryElementHtmlFor(array $allowed): ?string
    {
	    return in_array(FactoryElementAttribute::FOR->value, $allowed, TRUE) ? $this->FactoryElementHtmlFor : NULL;
    }
}


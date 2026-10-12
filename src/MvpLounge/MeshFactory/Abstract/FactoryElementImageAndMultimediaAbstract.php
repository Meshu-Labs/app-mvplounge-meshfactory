<?php

namespace MvpLounge\MeshFactory\Abstract;

require_once __DIR__ . '/../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

use MvpLounge\MeshFactory\Enum\FactoryElementAttribute;

require_once __DIR__ . '/FactoryElementHtmlAbstract.php';
require_once __DIR__ . '/../Enum/FactoryElementAttribute.php';

abstract class FactoryElementImageAndMultimediaAbstract extends FactoryElementHtmlAbstract
{
    protected array $AllowedFactoryElementAttributes = [
        FactoryElementAttribute::SRC,
        FactoryElementAttribute::ALT,
        FactoryElementAttribute::LOADING,
        FactoryElementAttribute::DECODING,
        FactoryElementAttribute::FETCHPRIORITY,
        FactoryElementAttribute::PRELOAD,
        FactoryElementAttribute::POSTER,
        FactoryElementAttribute::AUTOPLAY,
        FactoryElementAttribute::CONTROLS,
        FactoryElementAttribute::LOOP,
        FactoryElementAttribute::MUTED,
        FactoryElementAttribute::CROSSORIGIN
    ];

    protected ?string $FactoryElementMediaSrc = NULL;
    protected ?string $FactoryElementMediaAlt = NULL;
    protected ?string $FactoryElementMediaLoading = NULL;
    protected ?string $FactoryElementMediaDecoding = NULL;
    protected ?string $FactoryElementMediaFetchpriority = NULL;
    protected ?string $FactoryElementMediaPreload = NULL;
    protected ?string $FactoryElementMediaPoster = NULL;
    protected bool $FactoryElementMediaAutoplay = FALSE;
    protected bool $FactoryElementMediaControls = FALSE;
    protected bool $FactoryElementMediaLoop = FALSE;
    protected bool $FactoryElementMediaMuted = FALSE;
    protected ?string $FactoryElementMediaCrossorigin = NULL;

    protected function __process_src($params): void
    {
        if (array_key_exists('src', $params)) {
            $this->addSrc($params['src']);
        }
    }

    protected function __process_alt($params): void
    {
        if (array_key_exists('alt', $params)) {
            $this->addAlt($params['alt']);
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

    protected function __process_preload($params): void
    {
        if (array_key_exists('preload', $params)) {
            $this->addPreload($params['preload']);
        }
    }

    protected function __process_poster($params): void
    {
        if (array_key_exists('poster', $params)) {
            $this->addPoster($params['poster']);
        }
    }

    protected function __process_autoplay($params): void
    {
        if (array_key_exists('autoplay', $params)) {
            $this->addAutoplay($params['autoplay']);
        }
    }

    protected function __process_controls($params): void
    {
        if (array_key_exists('controls', $params)) {
            $this->addControls($params['controls']);
        }
    }

    protected function __process_loop($params): void
    {
        if (array_key_exists('loop', $params)) {
            $this->addLoop($params['loop']);
        }
    }

    protected function __process_muted($params): void
    {
        if (array_key_exists('muted', $params)) {
            $this->addMuted($params['muted']);
        }
    }

    protected function __process_crossorigin($params): void
    {
        if (array_key_exists('crossorigin', $params)) {
            $this->addCrossorigin($params['crossorigin']);
        }
    }

    public function addSrc($src): static
    {
        $this->FactoryElementMediaSrc = is_null($src) ? NULL : (string) $src;
        return $this;
    }

    public function addAlt($alt): static
    {
        $this->FactoryElementMediaAlt = is_null($alt) ? NULL : (string) $alt;
        return $this;
    }

    public function addLoading($loading): static
    {
        $this->FactoryElementMediaLoading = is_null($loading) ? NULL : (string) $loading;
        return $this;
    }

    public function addDecoding($decoding): static
    {
        $this->FactoryElementMediaDecoding = is_null($decoding) ? NULL : (string) $decoding;
        return $this;
    }

    public function addFetchPriority($fetchPriority): static
    {
        $this->FactoryElementMediaFetchpriority = is_null($fetchPriority) ? NULL : (string) $fetchPriority;
        return $this;
    }

    public function addPreload($preload): static
    {
        $this->FactoryElementMediaPreload = is_null($preload) ? NULL : (string) $preload;
        return $this;
    }

    public function addPoster($poster): static
    {
        $this->FactoryElementMediaPoster = is_null($poster) ? NULL : (string) $poster;
        return $this;
    }

    public function addAutoplay($autoplay): static
    {
        $this->FactoryElementMediaAutoplay = (bool) $autoplay;
        return $this;
    }

    public function addControls($controls): static
    {
        $this->FactoryElementMediaControls = (bool) $controls;
        return $this;
    }

    public function addLoop($loop): static
    {
        $this->FactoryElementMediaLoop = (bool) $loop;
        return $this;
    }

    public function addMuted($muted): static
    {
        $this->FactoryElementMediaMuted = (bool) $muted;
        return $this;
    }

    public function addCrossorigin($crossorigin): static
    {
        $this->FactoryElementMediaCrossorigin = is_null($crossorigin) ? NULL : (string) $crossorigin;
        return $this;
    }

    public function getFactoryAttributePropertyCollection(): array
    {
        $_allowed = $this->getAllowedFactoryElementAttributes();

        return array_merge(
            $this->getDefaultFactoryAttributePropertyCollection(),
            [
                'src' => in_array(FactoryElementAttribute::SRC->value, $_allowed, TRUE) ? $this->FactoryElementMediaSrc : NULL,
                'alt' => in_array(FactoryElementAttribute::ALT->value, $_allowed, TRUE) ? $this->FactoryElementMediaAlt : NULL,
                'loading' => in_array(FactoryElementAttribute::LOADING->value, $_allowed, TRUE) ? $this->FactoryElementMediaLoading : NULL,
                'decoding' => in_array(FactoryElementAttribute::DECODING->value, $_allowed, TRUE) ? $this->FactoryElementMediaDecoding : NULL,
                'fetchpriority' => in_array(FactoryElementAttribute::FETCHPRIORITY->value, $_allowed, TRUE) ? $this->FactoryElementMediaFetchpriority : NULL,
                'preload' => in_array(FactoryElementAttribute::PRELOAD->value, $_allowed, TRUE) ? $this->FactoryElementMediaPreload : NULL,
                'poster' => in_array(FactoryElementAttribute::POSTER->value, $_allowed, TRUE) ? $this->FactoryElementMediaPoster : NULL,
                'autoplay' => in_array(FactoryElementAttribute::AUTOPLAY->value, $_allowed, TRUE) && $this->FactoryElementMediaAutoplay,
                'controls' => in_array(FactoryElementAttribute::CONTROLS->value, $_allowed, TRUE) && $this->FactoryElementMediaControls,
                'loop' => in_array(FactoryElementAttribute::LOOP->value, $_allowed, TRUE) && $this->FactoryElementMediaLoop,
                'muted' => in_array(FactoryElementAttribute::MUTED->value, $_allowed, TRUE) && $this->FactoryElementMediaMuted,
                'crossorigin' => in_array(FactoryElementAttribute::CROSSORIGIN->value, $_allowed, TRUE) ? $this->FactoryElementMediaCrossorigin : NULL
            ]
        );
    }
}

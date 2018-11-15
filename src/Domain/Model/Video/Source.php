<?php

namespace CMProductions\VideosImporter\Domain\Model\Video;

class Source
{
    const GLORF = 'glorf';
    const FLUB = 'flub';

    private const ALLOWED_VALUES = [
        self::GLORF,
        self::FLUB
    ];

    /** @var string */
    private $name;

    public function __construct($name)
    {
        $this->setName($name);
    }

    private function setName($name)
    {
        if (!in_array($name, self::ALLOWED_VALUES, true)) {
            throw new \InvalidArgumentException(
                "The source name does not exist: $name" . PHP_EOL
                . 'Existing sources are: ' . implode(',', self::ALLOWED_VALUES)
            );
        }

        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}

<?php

namespace CMProductions\VideosImporter\Domain\Model\Video;

class Tag
{
    /** @var string */
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}

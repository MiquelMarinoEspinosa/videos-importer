<?php

namespace CMProductions\VideosImporter\Application\UseCase\Video;

class ImportVideosRequest
{
    /** @var array */
    private $sources;

    public function __construct(array $sources)
    {
        $this->sources = $sources;
    }

    public function sources(): array
    {
        return $this->sources;
    }
}

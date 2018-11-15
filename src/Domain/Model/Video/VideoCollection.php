<?php

namespace CMProductions\VideosImporter\Domain\Model\Video;

class VideoCollection
{
    /** @var array */
    private $videos;

    public function __construct(array $videos)
    {
        $this->videos = $videos;
    }

    public function isEmpty(): bool
    {
        return empty($this->videos);
    }

    public function current()
    {
        return current($this->videos);
    }

    public function next()
    {
        return next($this->videos);
    }

    public function reset()
    {
        reset($this->videos);
    }
}

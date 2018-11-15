<?php

namespace CMProductions\VideosImporter\Application\DataTransformer\Video;

class VideoResource
{
    /** @var string */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $url;
    /** @var array */
    private $tags;
    /** @var string */
    private $sourceName;

    public function __construct(
        string $id,
        string $title,
        string $url,
        array $tags,
        string $sourceName
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->tags = $tags;
        $this->sourceName = $sourceName;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function tags(): array
    {
        return $this->tags;
    }

    public function sourceName(): string
    {
        return $this->sourceName;
    }
}

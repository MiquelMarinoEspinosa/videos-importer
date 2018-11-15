<?php

namespace CMProductions\VideosImporter\Domain\Model\Video;

class Video
{
    /** @var string */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $url;
    /** @var TagCollection */
    private $tagCollection;
    /** @var Source */
    private $source;

    private function __construct(
        string $id,
        string $title,
        string $url,
        TagCollection $tagCollection,
        Source $source
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->tagCollection = $tagCollection;
        $this->source = $source;
    }

    public static function create(
        $id,
        $title,
        $url,
        $tags,
        Source $source
    ): self {
        return new self(
            $id,
            $title,
            $url,
            TagCollection::create($tags),
            $source
        );
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

    public function currentTagValue()
    {
        if ($tag = $this->tagCollection->current()) {
            return $tag->value();
        }

        return false;
    }

    public function nextTagValue()
    {
        if ($tag = $this->tagCollection->next()) {
            return $tag->value();
        }

        return false;
    }

    public function sourceName(): string
    {
        return $this->source->name();
    }
}

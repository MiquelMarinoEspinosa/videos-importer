<?php

namespace CMProductions\VideosImporter\Domain\Model\Video;

class TagCollection
{
    /** @var Tag[] */
    private $tags;

    private function __construct(array $tags)
    {
        $this->tags = $tags;
    }

    public static function create(array $tags): self
    {
        $tagEntities = [];
        foreach ($tags as $tag) {
            $tagEntities[] = new Tag($tag);
        }

        return new self($tagEntities);
    }

    public function isEmpty(): bool
    {
        return empty($this->tags);
    }

    public function current()
    {
        return current($this->tags);
    }

    public function next()
    {
        return next($this->tags);
    }
}

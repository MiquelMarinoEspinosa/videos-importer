<?php

namespace CMProductions\VideosImporter\Application\DataTransformer\Video;

class VideoCollectionResource
{
    /** @var VideoResource[] */
    private $videoResources;

    public function __construct(array $videoResources)
    {
        $this->videoResources = $videoResources;
    }

    /**
     * @return VideoResource[]
     */
    public function videoResources(): array
    {
        return $this->videoResources;
    }
}

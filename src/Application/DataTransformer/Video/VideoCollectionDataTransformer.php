<?php

namespace CMProductions\VideosImporter\Application\DataTransformer\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Video;
use CMProductions\VideosImporter\Domain\Model\Video\VideoCollection;

class VideoCollectionDataTransformer
{
    public function transform(
        VideoCollection $videoCollection
    ): VideoCollectionResource {
        $videoResources = [];
        /** @var Video $video */
        $video = $videoCollection->current();
        do {
            $tags = $this->getTags($video);
            $videoResources[] = new VideoResource(
                $video->id(),
                $video->title(),
                $video->url(),
                $tags,
                $video->sourceName()
            );
        } while ($video = $videoCollection->next());

        return new VideoCollectionResource($videoResources);
    }

    private function getTags(Video $video): array
    {
        $tags = [];
        $tag = $video->currentTagValue();
        if (false === $tag) {
            return [];
        }
        do {
            $tags[] = $tag;
        } while ($tag = $video->nextTagValue());

        return $tags;
    }
}

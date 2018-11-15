<?php

namespace CMProductions\VideosImporter\Infrastructure\Importer\Glorf\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use CMProductions\VideosImporter\Infrastructure\Importer\Parser\Domain\Model\Video\Parser;

class GlorfParser extends Parser
{
    protected function extractVideosContent()
    {
        return json_decode($this->content, true)['videos'];
    }

    protected function extractTitle($videoContent)
    {
        return $videoContent['title'];
    }

    protected function extractUrl($videoContent)
    {
        return $videoContent['url'];
    }

    protected function extractTags($videoContent)
    {
        return $videoContent['tags'];
    }

    protected function sourceName(): string
    {
        return Source::GLORF;
    }
}

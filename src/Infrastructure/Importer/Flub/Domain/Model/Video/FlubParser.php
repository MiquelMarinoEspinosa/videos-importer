<?php

namespace CMProductions\VideosImporter\Infrastructure\Importer\Flub\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use CMProductions\VideosImporter\Infrastructure\Importer\Parser\Domain\Model\Video\Parser;

class FlubParser extends Parser
{
    protected function extractVideosContent()
    {
        return yaml_parse($this->content);
    }

    protected function extractTitle($videoContent)
    {
        return $videoContent['name'];
    }

    protected function extractUrl($videoContent)
    {
        return $videoContent['url'];
    }

    protected function extractTags($videoContent)
    {
        if (!isset($videoContent['labels'])) {
            return [];
        }

        return explode(',', $videoContent['labels']);
    }

    protected function sourceName(): string
    {
        return Source::FLUB;
    }
}

<?php

namespace CMProductions\VideosImporter\Infrastructure\Importer\Parser\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use CMProductions\VideosImporter\Domain\Model\Video\Video;
use CMProductions\VideosImporter\Domain\Model\Video\VideoCollection;
use Ramsey\Uuid\Uuid;

abstract class Parser
{
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function parse(): VideoCollection
    {
        $videosAsContent = $this->extractVideosContent();
        $videos = [];
        foreach ($videosAsContent as $videoAsContent) {
            $videos[] = Video::create(
                Uuid::uuid4(),
                $this->extractTitle($videoAsContent),
                $this->extractUrl($videoAsContent),
                $this->extractTags($videoAsContent),
                new Source($this->sourceName())
            );
        }

        return new VideoCollection($videos);
    }

    abstract protected function extractVideosContent();

    abstract protected function extractTitle($videoContent);

    abstract protected function extractUrl($videoContent);

    abstract protected function extractTags($videoContent);

    abstract protected function sourceName(): string;
}

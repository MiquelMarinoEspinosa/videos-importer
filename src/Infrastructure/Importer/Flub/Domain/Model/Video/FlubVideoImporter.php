<?php

namespace CMProductions\VideosImporter\Infrastructure\Importer\Flub\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use CMProductions\VideosImporter\Domain\Model\Video\VideoCollection;
use CMProductions\VideosImporter\Domain\Model\Video\VideoImporter;

class FlubVideoImporter implements VideoImporter
{
    public function import(Source $source): VideoCollection
    {
        $content = file_get_contents(__DIR__ . '/../../../../../feed-exports/flub/flub.yaml');

        return (new FlubParser($content))->parse();
    }
}

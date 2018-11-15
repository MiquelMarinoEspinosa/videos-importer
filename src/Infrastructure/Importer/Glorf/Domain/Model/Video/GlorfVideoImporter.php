<?php

namespace CMProductions\VideosImporter\Infrastructure\Importer\Glorf\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use CMProductions\VideosImporter\Domain\Model\Video\VideoCollection;
use CMProductions\VideosImporter\Domain\Model\Video\VideoImporter;

class GlorfVideoImporter implements VideoImporter
{
    public function import(Source $source): VideoCollection
    {
        $content = file_get_contents(__DIR__ . '/../../../../../feed-exports/glorf/glorf.json');

        return (new GlorfParser($content))->parse();
    }
}

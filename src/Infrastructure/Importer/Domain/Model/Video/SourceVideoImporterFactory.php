<?php

namespace CMProductions\VideosImporter\Infrastructure\Importer\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use CMProductions\VideosImporter\Domain\Model\Video\VideoImporter;
use CMProductions\VideosImporter\Domain\Model\Video\VideoImporterFactory;
use CMProductions\VideosImporter\Infrastructure\Importer\Flub\Domain\Model\Video\FlubVideoImporter;
use CMProductions\VideosImporter\Infrastructure\Importer\Glorf\Domain\Model\Video\GlorfVideoImporter;

class SourceVideoImporterFactory implements VideoImporterFactory
{
    public function create(Source $source): VideoImporter
    {
        switch ($source->name()) {
            case Source::GLORF:
                return new GlorfVideoImporter();
            case Source::FLUB:
                return new FlubVideoImporter();
            default:
                throw new \InvalidArgumentException(
                    'Importer not defined for provider: ' . $source->name()
                );
        }
    }
}

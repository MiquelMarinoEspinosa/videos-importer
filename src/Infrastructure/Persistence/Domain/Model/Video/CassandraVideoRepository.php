<?php

namespace CMProductions\VideosImporter\Infrastructure\Persistence\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Video;
use CMProductions\VideosImporter\Domain\Model\Video\VideoRepository;

class CassandraVideoRepository implements VideoRepository
{
    public function persist(Video $video)
    {
        throw new \BadMethodCallException(
            'Future date persistence that will be implemented in a future'
        );
    }
}

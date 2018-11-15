<?php

namespace CMProductions\VideosImporter\Infrastructure\Persistence\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Video;
use CMProductions\VideosImporter\Domain\Model\Video\VideoRepository;

class MysqlVideoRepository implements VideoRepository
{
    public function persist(Video $video)
    {
        throw new \BadMethodCallException(
            'Current data base implementation but I has not been implemented for the test purpose'
        );
    }
}

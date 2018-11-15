<?php

namespace CMProductions\VideosImporter\Infrastructure\Persistence\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Video;
use CMProductions\VideosImporter\Domain\Model\Video\VideoRepository;

class InMemoryVideoRepository implements VideoRepository
{
    /** @var Video[] */
    private $videos;

    public function __construct()
    {
        $this->videos = [];
    }

    public function persist(Video $video)
    {
        $this->videos[] = $video;
    }
}

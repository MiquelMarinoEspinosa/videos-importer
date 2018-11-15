<?php

namespace CMProductions\VideosImporter\Domain\Model\Video;

interface VideoRepository
{
    public function persist(Video $video);
}

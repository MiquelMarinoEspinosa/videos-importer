<?php

namespace CMProductions\VideosImporter\Domain\Model\Video;

interface VideoImporterFactory
{
    public function create(Source $source): VideoImporter;
}

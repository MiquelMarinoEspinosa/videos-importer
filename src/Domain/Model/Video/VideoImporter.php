<?php

namespace CMProductions\VideosImporter\Domain\Model\Video;

interface VideoImporter
{
    public function import(Source $source): VideoCollection;
}

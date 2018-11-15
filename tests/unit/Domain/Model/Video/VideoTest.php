<?php

namespace CMProductions\VideosImporter\c\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use PHPUnit\Framework\TestCase;
use CMProductions\VideosImporter\Domain\Model\Video\Video;

class VideoTest extends TestCase
{
    private const SOURCE_NAME = 'glorf';
    private const VIDEO_ID = 'wzasd-erty-wsdf-bmnc';
    private const URL = 'http://glorf.com/videos/3';
    private const TITLE = 'science experiment goes wrong';
    private const A_TAG_VALUE = 'microwave';
    private const ANOTHER_TAG_VALUE = 'cats';

    public function testShouldReturnTheId()
    {
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [],
            $this->buildSource()
        );

        $this->assertSame(
            self::VIDEO_ID,
            $video->id()
        );
    }

    public function testShouldReturnTheTitle()
    {
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [],
            $this->buildSource()
        );

        $this->assertSame(
            self::TITLE,
            $video->title()
        );
    }

    public function testShouldReturnTheUrl()
    {
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [],
            $this->buildSource()
        );

        $this->assertSame(
            self::URL,
            $video->url()
        );
    }

    public function testShouldReturnNoTagValue()
    {
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [],
            $this->buildSource()
        );

        $this->assertFalse(
            $video->currentTagValue()
        );
    }

    public function testShouldReturnTheCurrentTagValue()
    {
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [self::A_TAG_VALUE],
            $this->buildSource()
        );

        $this->assertSame(
            self::A_TAG_VALUE,
            $video->currentTagValue()
        );
    }

    public function testShouldReturnNoNextTagValue()
    {
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [self::A_TAG_VALUE],
            $this->buildSource()
        );

        $this->assertFalse(
            $video->nextTagValue()
        );
    }

    public function testShouldReturnTheNextTagValue()
    {
        $tags = [self::A_TAG_VALUE, self::ANOTHER_TAG_VALUE];
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            $tags,
            $this->buildSource()
        );

        $this->assertSame(
            self::ANOTHER_TAG_VALUE,
            $video->nextTagValue()
        );
    }

    public function testShouldReturnTheSourceName()
    {
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [],
            $this->buildSource()
        );

        $this->assertSame(
            self::SOURCE_NAME,
            $video->sourceName()
        );
    }

    private function buildSource(): Source
    {
        return new Source(
            self::SOURCE_NAME
        );
    }
}

<?php

namespace CMProductions\VideosImporter\Tests\Unit\Application\DataTansformer\Video;

use PHPUnit\Framework\TestCase;
use CMProductions\VideosImporter\Application\DataTransformer\Video\VideoResource;

class VideoResourceTest extends TestCase
{
    private const VIDEO_ID = 'wzasd-erty-wsdf-bmnc';
    private const URL = 'http://glorf.com/videos/3';
    private const TITLE = 'science experiment goes wrong';
    private const A_TAG_VALUE = 'microwave';
    private const SOURCE_NAME = 'glorf';
    /** @var VideoResource */
    private $videoResoource;

    protected function setUp()
    {
        $this->videoResoource = new VideoResource(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [self::A_TAG_VALUE],
            self::SOURCE_NAME
        );
    }

    public function testShouldReturnTheId()
    {
        $this->assertSame(
            self::VIDEO_ID,
            $this->videoResoource->id()
        );
    }

    public function testShouldReturnTheTitle()
    {
        $this->assertSame(
            self::TITLE,
            $this->videoResoource->title()
        );
    }

    public function testShouldReturnTheUrl()
    {
        $this->assertSame(
            self::URL,
            $this->videoResoource->url()
        );
    }

    public function testShouldReturnTheTags()
    {
        $this->assertSame(
            [self::A_TAG_VALUE],
            $this->videoResoource->tags()
        );
    }

    public function testShouldReturnTheSourceName()
    {
        $this->assertSame(
            self::SOURCE_NAME,
            $this->videoResoource->sourceName()
        );
    }
}

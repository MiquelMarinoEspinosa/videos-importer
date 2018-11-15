<?php

namespace CMProductions\VideosImporter\c\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use CMProductions\VideosImporter\Domain\Model\Video\Video;
use PHPUnit\Framework\TestCase;
use CMProductions\VideosImporter\Domain\Model\Video\VideoCollection;

class VideoCollectionTest extends TestCase
{
    private const SOURCE_NAME = 'glorf';

    private const VIDEO_ID = 'wzasd-erty-wsdf-bmnc';
    private const URL = 'http://glorf.com/videos/3';
    private const TITLE = 'science experiment goes wrong';

    private const ANOTHER_VIDEO_ID = 'bmnc-erty-wsdf-wzasd';
    private const ANOTHER_URL = 'http://glorf.com/videos/4';
    private const ANOTHER_TITLE = 'amazing dog can talk';

    public function testShouldReturnAnEmptyCollection()
    {
        $this->assertTrue(
            (new VideoCollection([]))->isEmpty()
        );
    }

    public function testShouldReturnAnNoCurrentVideo()
    {
        $this->assertFalse(
            (new VideoCollection([]))->current()
        );
    }

    public function testShouldReturnAnNoNextVideo()
    {
        $this->assertFalse(
            (new VideoCollection([]))->next()
        );
    }

    public function testShouldReturnAnNotEmptyCollection()
    {
        $source = new Source(self::SOURCE_NAME);
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [],
            $source
        );

        $videos = [$video];

        $this->assertFalse(
            (new VideoCollection($videos))->isEmpty()
        );
    }

    public function testShouldReturnTheCurrentVideo()
    {
        $source = new Source(self::SOURCE_NAME);
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [],
            $source
        );

        $videos = [$video];

        $this->assertEquals(
            $video,
            (new VideoCollection($videos))->current()
        );
    }

    public function testShouldReturnTheNextVideo()
    {
        $source = new Source(self::SOURCE_NAME);
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [],
            $source
        );

        $anotherVideo = Video::create(
            self::ANOTHER_VIDEO_ID,
            self::ANOTHER_TITLE,
            self::ANOTHER_URL,
            [],
            $source
        );

        $videos = [$video, $anotherVideo];

        $this->assertEquals(
            $anotherVideo,
            (new VideoCollection($videos))->next()
        );
    }
}

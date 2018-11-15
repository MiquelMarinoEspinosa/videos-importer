<?php

namespace CMProductions\VideosImporter\Tests\Unit\Domain\Model\Video;

use PHPUnit\Framework\TestCase;
use CMProductions\VideosImporter\Domain\Model\Video\Tag;

class TagTest extends TestCase
{
    private const VALUE = 'amazing';

    public function testShouldReturnTheValue()
    {
        $value = self::VALUE;
        $this->assertSame(
            $value,
            (new Tag($value))->value()
        );
    }
}

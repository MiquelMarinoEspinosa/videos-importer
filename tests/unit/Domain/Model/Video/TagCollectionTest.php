<?php

namespace CMProductions\VideosImporter\c\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Tag;
use PHPUnit\Framework\TestCase;
use CMProductions\VideosImporter\Domain\Model\Video\TagCollection;

class TagCollectionTest extends TestCase
{
    private const A_VALUE = 'amazing';
    private const ANOTHER_VALUE = 'cats';

    public function testShouldCreateAnEmptyCollection()
    {
        $this->assertTrue(
            (TagCollection::create([]))->isEmpty()
        );
    }

    public function testShouldCreateAnNotEmptyCollection()
    {
        $tagsAsArray = [self::A_VALUE];

        $this->assertFalse(
            (TagCollection::create($tagsAsArray))->isEmpty()
        );
    }

    public function testShouldReturnTheCurrentValue()
    {
        $aTag = new Tag(self::A_VALUE);
        $tagsAsArray = [self::A_VALUE];
        $tagCollection = TagCollection::create($tagsAsArray);

        $this->assertEquals(
            $aTag,
            $tagCollection->current()
        );
    }

    public function testShouldReturnTheNextValue()
    {
        $anotherTag = new Tag(self::ANOTHER_VALUE);
        $tagsAsArray = [self::A_VALUE, self::ANOTHER_VALUE];
        $tagCollection = TagCollection::create($tagsAsArray);
        $this->assertEquals(
            $anotherTag,
            $tagCollection->next()
        );
    }

    public function testShouldReturnFalseAsTheNextValue()
    {
        $tagsAsArray = [self::A_VALUE, self::ANOTHER_VALUE];
        $tagCollection = TagCollection::create($tagsAsArray);
        $tagCollection->next();
        $this->assertFalse(
            $tagCollection->next()
        );
    }
}

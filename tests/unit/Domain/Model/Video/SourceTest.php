<?php

namespace CMProductions\VideosImporter\Tests\Unit\Domain\Model\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use PHPUnit\Framework\TestCase;

class SourceTest extends TestCase
{
    private const NOT_ALLOWED = 'not_allowed';
    private const ALLOWED_VALUES = [
        ['glorf'],
        ['flub']
    ];

    public function testNotExistsSourceShouldThrowAnException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Source(self::NOT_ALLOWED);
    }

    /**
     * @dataProvider getAllowedValues
     * @param string $name
     */
    public function testShouldReturnTheName(string $name)
    {
        $this->assertSame(
            $name,
            (new Source($name))->name()
        );
    }

    public function getAllowedValues(): array
    {
        return self::ALLOWED_VALUES;
    }
}

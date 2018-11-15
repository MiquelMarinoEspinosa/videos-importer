<?php

namespace CMProductions\VideosImporter\Tests\Integration\Application\UseCase\Video;

use CMProductions\VideosImporter\Application\DataTransformer\Video\VideoCollectionDataTransformer;
use CMProductions\VideosImporter\Application\DataTransformer\Video\VideoResource;
use CMProductions\VideosImporter\Application\UseCase\Video\ImportVideosRequest;
use CMProductions\VideosImporter\Infrastructure\Persistence\Domain\Model\Video\InMemoryVideoRepository;
use CMProductions\VideosImporter\Infrastructure\Importer\Domain\Model\Video\SourceVideoImporterFactory;
use PHPUnit\Framework\TestCase;
use CMProductions\VideosImporter\Application\UseCase\Video\ImportVideosUseCase;

class ImportVideosUseCaseTest extends TestCase
{
    private const SOURCE_NAMES = [
        ['glorf'],
        ['flub']
    ];

    /** @var ImportVideosUseCase */
    private $importVideosUseCase;

    protected function setUp()
    {
        $videoImporterFactory = new SourceVideoImporterFactory();
        $videoRepository = new InMemoryVideoRepository();
        $videoCollectionDataTransformer = new VideoCollectionDataTransformer();

        $this->importVideosUseCase = new ImportVideosUseCase(
            $videoImporterFactory,
            $videoRepository,
            $videoCollectionDataTransformer
        );
    }

    public function testGivenInvalidSourceWhenExecuteThenShouldThrownAnException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $importVideosRequest = new ImportVideosRequest(
            ['source_not_exists']
        );
        $this->importVideosUseCase->execute($importVideosRequest);
    }

    /**
     * @dataProvider getSourceNames
     * @param string $sourceName
     */
    public function testGivenSourceWhenExecuteThenShouldImportTheVideos(string $sourceName)
    {
        $importVideosRequest = new ImportVideosRequest(
            [$sourceName]
        );
        $videoCollectionResource =$this->importVideosUseCase->execute($importVideosRequest);
        $this->assertNotEmpty($videoCollectionResource->videoResources());
        /** @var VideoResource $videoResource */
        $videoResource = current($videoCollectionResource->videoResources());
        $this->assertSame(
            $sourceName,
            $videoResource->sourceName()
        );
    }

    public function getSourceNames(): array
    {
        return self::SOURCE_NAMES;
    }
}

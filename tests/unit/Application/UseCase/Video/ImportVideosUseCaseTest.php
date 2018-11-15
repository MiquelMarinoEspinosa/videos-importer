<?php

namespace CMProductions\VideosImporter\Tests\Unit\Application\UseCase\Video;

use CMProductions\VideosImporter\Application\DataTransformer\Video\VideoCollectionDataTransformer;
use CMProductions\VideosImporter\Application\DataTransformer\Video\VideoCollectionResource;
use CMProductions\VideosImporter\Application\DataTransformer\Video\VideoResource;
use CMProductions\VideosImporter\Application\UseCase\Video\ImportVideosRequest;
use CMProductions\VideosImporter\Domain\Model\Video\Source;
use CMProductions\VideosImporter\Domain\Model\Video\Video;
use CMProductions\VideosImporter\Domain\Model\Video\VideoCollection;
use CMProductions\VideosImporter\Domain\Model\Video\VideoImporterFactory;
use CMProductions\VideosImporter\Domain\Model\Video\VideoRepository;
use CMProductions\VideosImporter\Domain\Model\Video\VideoImporter;
use PHPUnit\Framework\TestCase;
use CMProductions\VideosImporter\Application\UseCase\Video\ImportVideosUseCase;

class ImportVideosUseCaseTest extends TestCase
{
    private const SOURCE_NAME = 'glorf';

    private const VIDEO_ID = 'wzasd-erty-wsdf-bmnc';
    private const URL = 'http://glorf.com/videos/3';
    private const TITLE = 'science experiment goes wrong';

    private const ANOTHER_VIDEO_ID = 'bmnc-erty-wsdf-wzasd';
    private const ANOTHER_URL = 'http://glorf.com/videos/4';
    private const ANOTHER_TITLE = 'amazing dog can talk';

    private const A_TAG_VALUE = 'microwave';

    public function testGivenNoSourcesWhenExecuteThenReturnsEmptyResourceCollection()
    {
        $videoImporterFactory = $this->prophesize(VideoImporterFactory::class)->reveal();
        $videoRepository = $this->prophesize(VideoRepository::class)->reveal();
        $videoCollectionDataTransformer = new VideoCollectionDataTransformer();
        $importVideosUseCase =new ImportVideosUseCase(
            $videoImporterFactory,
            $videoRepository,
            $videoCollectionDataTransformer
        );
        $importVideosRequest = new ImportVideosRequest([]);
        $videoCollectionResources = $importVideosUseCase->execute($importVideosRequest);
        $this->assertEmpty($videoCollectionResources->videoResources());
    }

    public function testGivenASourceWhenExecuteThenReturnsTheResourceCollection()
    {
        $source = new Source(self::SOURCE_NAME);
        $videoCollection = $this->buildVideoCollection($source);
        $expectedVideoCollectionResource = $this->buildVideoCollectionResource($videoCollection);
        $videoImporterFactory = $this->buildVideoFactory($source, $videoCollection);
        $videoRepository = $this->buildVideoRepository($videoCollection);
        $videoCollectionDataTransformer = new VideoCollectionDataTransformer();
        $importVideosUseCase =new ImportVideosUseCase(
            $videoImporterFactory,
            $videoRepository,
            $videoCollectionDataTransformer
        );
        $importVideosRequest = new ImportVideosRequest([self::SOURCE_NAME]);
        $videoCollectionResource = $importVideosUseCase->execute($importVideosRequest);

        $this->assertEquals(
            $expectedVideoCollectionResource,
            $videoCollectionResource
        );
    }

    private function buildVideoCollection(Source $source): VideoCollection
    {
        $video = Video::create(
            self::VIDEO_ID,
            self::TITLE,
            self::URL,
            [self::A_TAG_VALUE],
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

        return new VideoCollection($videos);
    }

    private function buildVideoCollectionResource(
        VideoCollection $videoCollection
    ): VideoCollectionResource {
        $videoResources = [];
        /** @var Video $video */
        $video = $videoCollection->current();
        do {
            $tag = $video->currentTagValue();
            $tags = [$tag];
            if (false === $tag) {
                $tags = [];
            }
            $videoResources[] = new VideoResource(
                $video->id(),
                $video->title(),
                $video->url(),
                $tags,
                $video->sourceName()
            );
        } while ($video = $videoCollection->next());
        $videoCollection->reset();

        return new VideoCollectionResource($videoResources);
    }

    private function buildVideoFactory(
        Source $source,
        VideoCollection $videoCollection
    ): VideoImporterFactory {
        $videoImporter = $this->prophesize(VideoImporter::class);
        $videoImporter
            ->import($source)
            ->shouldBeCalled()
            ->willReturn($videoCollection);
        $videoImporterFactory = $this->prophesize(VideoImporterFactory::class);
        $videoImporterFactory
            ->create($source)
            ->shouldBeCalled()
            ->willReturn($videoImporter->reveal());

        return $videoImporterFactory->reveal();
    }

    private function buildVideoRepository(
        VideoCollection $videoCollection
    ): VideoRepository {
        $videoRepository = $this->prophesize(VideoRepository::class);
        $videoRepository->persist($videoCollection->current())->shouldBeCalled();
        $videoRepository->persist($videoCollection->next())->shouldBeCalled();
        $videoCollection->reset();

        return $videoRepository->reveal();
    }
}

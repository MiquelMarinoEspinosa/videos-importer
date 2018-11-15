<?php

namespace CMProductions\VideosImporter\Application\UseCase\Video;

use CMProductions\VideosImporter\Domain\Model\Video\Source;
use CMProductions\VideosImporter\Domain\Model\Video\VideoCollection;
use CMProductions\VideosImporter\Domain\Model\Video\VideoImporterFactory;
use CMProductions\VideosImporter\Domain\Model\Video\VideoRepository;
use CMProductions\VideosImporter\Application\DataTransformer\Video\VideoCollectionDataTransformer;
use CMProductions\VideosImporter\Application\DataTransformer\Video\VideoCollectionResource;

class ImportVideosUseCase
{
    /** @var VideoImporterFactory */
    private $videoImporterFactory;
    /** @var VideoRepository */
    private $videoRepository;
    /** @var VideoCollectionDataTransformer */
    private $videoCollectionDataTransformer;

    public function __construct(
        VideoImporterFactory $videoImporterFactory,
        VideoRepository $videoRepository,
        VideoCollectionDataTransformer $videoCollectionDataTransformer
    ) {

        $this->videoImporterFactory = $videoImporterFactory;
        $this->videoRepository = $videoRepository;
        $this->videoCollectionDataTransformer = $videoCollectionDataTransformer;
    }

    public function execute(ImportVideosRequest $importVideosRequest): VideoCollectionResource
    {
        $sources = $importVideosRequest->sources();
        if (empty($sources)) {
            return new VideoCollectionResource([]);
        }

        $videoResources = [];
        foreach ($sources as $source) {
            $sourceEntity = new Source($source);
            $videoImporter = $this->videoImporterFactory->create($sourceEntity);
            $videoCollection = $videoImporter->import($sourceEntity);
            $this->persistVideoCollection($videoCollection);
            $videoCollectionResource = $this->videoCollectionDataTransformer->transform(
                $videoCollection
            );
            $videoResources = array_merge(
                $videoResources,
                $videoCollectionResource->videoResources()
            );
        }

        return new VideoCollectionResource($videoResources);
    }

    private function persistVideoCollection(VideoCollection $videoCollection)
    {
        $video = $videoCollection->current();
        do {
            $this->videoRepository->persist($video);
        } while ($video = $videoCollection->next());
        $videoCollection->reset();
    }
}

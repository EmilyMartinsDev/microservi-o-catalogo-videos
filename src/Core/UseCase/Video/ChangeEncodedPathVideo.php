<?php

namespace Core\UseCase\Video;

use Core\Domain\Enum\MediaStatus;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Domain\ValueObject\Media;
use Core\UseCase\DTO\Video\ChangeEncoded\ChangeEncodedVideoInputDTO;
use Core\UseCase\DTO\Video\ChangeEncoded\ChangeEncodedVideoOutputDTO;

class ChangeEncodedPathVideo
{
    public function __construct(
        protected VideoRepositoryInterface $repository
    ) {
    }

    public function exec(ChangeEncodedVideoInputDTO $input): ChangeEncodedVideoOutputDTO
    {
        $entity = $this->repository->findById($input->id);

        $entity->setVideoFile(
            new Media(
                filePath: $entity->videoFile()?->filePath ?? '',
                mediaStatus: MediaStatus::COMPLETE,
                encodedPath: $input->encodedPath
            )
        );

        $this->repository->updateMedia($entity);

        return new ChangeEncodedVideoOutputDTO(
            id: $entity->id(),
            encodedPath: $input->encodedPath
        );
    }
}
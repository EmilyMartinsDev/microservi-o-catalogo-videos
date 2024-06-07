<?php

namespace Core\UseCase\Video;

use Core\Domain\Repository\VideoRepositoryInterface;
use Core\UseCase\DTO\Video\Delete\DeleteInputVideoDTO;
use Core\UseCase\DTO\Video\Delete\DeleteOutputVideoDTO;

class DeleteVideoUseCase
{
    public function __construct(
        private VideoRepositoryInterface $repository,
    ) {
    }

    public function exec(DeleteInputVideoDTO $input): DeleteOutputVideoDTO
    {
        $deleted = $this->repository->delete($input->id);

        return new DeleteOutputVideoDTO(
            deleted: $deleted
        );
    }
}
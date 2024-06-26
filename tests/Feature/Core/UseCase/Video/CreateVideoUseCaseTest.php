<?php

namespace Tests\Feature\Core\UseCase\Video;

use Core\Domain\Builder\Video\Builder;
use Core\Domain\Enum\Rating;
use Core\UseCase\DTO\Video\Create\CreateInputVideoDTO;
use Core\UseCase\Video\BaseVideoUseCase;
use Core\UseCase\Video\CreateVideoUseCase;

class CreateVideoUseCaseTest extends BaseVideoUseCase
{
    public function useCase(): string
    {
        return CreateVideoUseCase::class;
    }

    public function getBuilder(): Builder
    {
    }

    public function inputDTO(
        array $categories = [],
        array $genres = [],
        array $castMembers = [],
        ?array $videoFile = null,
        ?array $trailerFile = null,
        ?array $bannerFile = null,
        ?array $thumbFile = null,
        ?array $thumbHalf = null,
    ): object {
        return new CreateInputVideoDTO(
            title: 'test',
            description: 'test',
            yearLaunched: 2020,
            duration: 120,
            opened: true,
            rating: Rating::L,
            categories: $categories,
            genres: $genres,
            castMembers: $castMembers,
            videoFile: $videoFile,
            trailerFile: $trailerFile,
            bannerFile: $bannerFile,
            thumbFile: $thumbFile,
            thumbHalf: $thumbHalf,
        );
    }
}

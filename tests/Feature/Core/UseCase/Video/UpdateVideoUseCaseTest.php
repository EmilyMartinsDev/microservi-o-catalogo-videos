<?php

namespace Tests\Feature\Core\UseCase\Video;

use App\Models\Video;
use Core\Domain\Builder\Video\Builder;
use Core\UseCase\DTO\Video\Update\UpdateInputVideoDTO;
use Core\UseCase\Video\BaseVideoUseCase;
use Core\UseCase\Video\UpdateVideoUseCase;

class UpdateVideoUseCaseTest extends BaseVideoUseCase
{
    public function useCase(): string
    {
        return UpdateVideoUseCase::class;
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
        $video = Video::factory()->create();

        return new UpdateInputVideoDTO(
            id: $video->id,
            title: 'test',
            description: 'test',
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

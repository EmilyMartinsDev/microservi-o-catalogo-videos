<?php

namespace Tests\Unit\UseCase\Video;

use Core\Domain\ValueObject\Uuid;
use Core\UseCase\DTO\Video\Update\UpdateInputVideoDTO;
use Core\UseCase\DTO\Video\Update\UpdateOutputVideoDTO;
use Core\UseCase\Video\UpdateVideoUseCase;
use Mockery;

class UpdateVideoUseCaseUnitTest extends BaseVideoUseCaseUnitTest
{
    public function test_exec_input_output()
    {
        $this->createUseCase();

        $response = $this->useCase->exec(
            input: $this->createMockInputDTO(),
        );

        $this->assertInstanceOf(UpdateOutputVideoDTO::class, $response);
    }

    protected function nameActionRepository(): string
    {
        return 'update';
    }

    protected function getUseCase(): string
    {
        return UpdateVideoUseCase::class;
    }

    protected function createMockInputDTO(
        array $categoriesIds = [],
        array $genresIds = [],
        array $castMembersIds = [],
        ?array $videoFile = null,
        ?array $trailerFile = null,
        ?array $thumbFile = null,
        ?array $thumbHalf = null,
        ?array $bannerFile = null,
    ) {
        return Mockery::mock(UpdateInputVideoDTO::class, [
            Uuid::random(),
            'title',
            'desc',
            $categoriesIds,
            $genresIds,
            $castMembersIds,
            $videoFile,
            $trailerFile,
            $thumbFile,
            $thumbHalf,
            $bannerFile,
        ]);
    }
}

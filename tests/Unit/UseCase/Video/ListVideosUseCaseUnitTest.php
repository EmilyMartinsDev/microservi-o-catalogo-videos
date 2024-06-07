<?php

namespace Tests\Unit\UseCase\Video;

use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\UseCase\DTO\Video\List\PaginateInputVideoDTO;
use Core\UseCase\DTO\Video\List\PaginateOutputVideoDTO;
use Core\UseCase\Video\ListVideosUseCase;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;
use Tests\Unit\UseCase\UseCaseTrait;

class ListVideosUseCaseUnitTest extends TestCase
{
    use UseCaseTrait;

    public function test_list_paginate()
    {
        $useCase = new ListVideosUseCase(
            repository: $this->mockRepository()
        );

        $response = $useCase->exec(
            input: $this->mockInputDTO()
        );

        $this->assertInstanceOf(PaginationInterface::class, $response);

        Mockery::close();
    }

    private function mockRepository()
    {
        $mockRepository = Mockery::mock(stdClass::class, VideoRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')
                        ->once()
                        ->andReturn($this->mockPagination());

        return $mockRepository;
    }

    private function mockInputDTO()
    {
        return Mockery::mock(PaginateInputVideoDTO::class, [
            '',
            'DESC',
            1,
            15,
        ]);
    }
}
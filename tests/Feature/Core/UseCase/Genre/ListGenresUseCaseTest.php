<?php

namespace Tests\Feature\Core\UseCase\Genre;

use App\Models\Genre;
use App\Models\Genre as Model;
use App\Repositories\Eloquent\GenreEloquentRepository;
use Core\UseCase\DTO\Genre\list\ListGenresInputDto;
use Core\UseCase\DTO\Genre\List\ListGenresOutputDto;
use Core\UseCase\Genre\ListGenresUseCase;
use Tests\TestCase;

class ListGenresUseCaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPaginate()
    {

        $useCase = new ListGenresUseCase(
            new GenreEloquentRepository(new Model())
        );

        Genre::factory()->count(100)->create();
        $responseUseCase = $useCase->execute(
            new ListGenresInputDto()
        );
        $this->assertInstanceOf(ListGenresOutputDto::class, $responseUseCase);
        $this->assertEquals(15, count($responseUseCase->items));
        $this->assertEquals(100, $responseUseCase->total);

    }
}

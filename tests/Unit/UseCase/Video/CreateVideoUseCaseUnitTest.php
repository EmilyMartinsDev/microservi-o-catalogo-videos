<?php

namespace Tests\Unit\UseCase\Video;

use Core\Domain\Entity\Video;
use Core\Domain\Enum\Rating;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\UseCase\DTO\Video\Create\CreateInputVideoDTO;
use Core\UseCase\DTO\Video\Create\CreateOutputVideoDTO;
use Core\UseCase\Interfaces\FileStorageInterface;
use Core\UseCase\Interfaces\TransactionInterface;
use Mockery;
use PHPUnit\Framework\TestCase;
use Core\UseCase\Video\CreateVideoUseCase as UseCase;
use Core\UseCase\Video\Interfaces\VideoEventManagerInterface;
use stdClass;

class CreateVideoUseCaseUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_constructor()
    {
     
       $useCase = new UseCase(
        repository: $this->createMockRepository(),
        transaction: $this->createMockTransaction(),
        storage: $this->createMockFileStorage(),
        eventManager: $this->createMockEventManager()
       );
       $this->assertTrue(true);
    }

    public function test_exec_input_output(){
        $useCase = new UseCase(
            repository: $this->createMockRepository(),
            transaction: $this->createMockTransaction(),
            storage: $this->createMockFileStorage(),
            eventManager: $this->createMockEventManager()
           );

        $response = $useCase->exec(input: $this->createMockInputDto());
         $this->assertInstanceOf(CreateOutputVideoDTO::class, $response);
    }


    private function createMockInputDto(){
        return Mockery::mock(CreateInputVideoDTO::class, [
            'title',
            'desc',
            2023,
            12,
            true,
            Rating::RATE10
        ]);
    }

    private function createMockRepository(){
        return Mockery::mock(stdClass::class, VideoRepositoryInterface::class);
    }
    private function createMockTransaction(){
        return Mockery::mock(stdClass::class, TransactionInterface::class);
    }

    private function createMockFileStorage(){
        return Mockery::mock(stdClass::class, FileStorageInterface::class);
    }
    
    private function createMockEventManager(){
        return Mockery::mock(stdClass::class, VideoEventManagerInterface::class);
    }
}


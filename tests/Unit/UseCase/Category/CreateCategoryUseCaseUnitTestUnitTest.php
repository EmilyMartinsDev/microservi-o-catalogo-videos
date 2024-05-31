<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateCategoryUseCaseUnitTest extends TestCase
{
   protected $mockEntity; 
   protected $mockRepo;
   protected $mockInputDto;
   protected $spy;
 public function  testCreateNewCategory()
 {    

   $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = "Teste";

        

      
        $this->mockEntity = Mockery::mock(Category::class, [ $uuid, $categoryName]);
        $this->mockEntity->shouldReceive('id')->andReturn($uuid);
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $this->mockRepo = Mockery::mock(CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('insert')->andReturn($this->mockEntity);

      $this->mockInputDto = Mockery::mock(CategoryCreateInputDto::class, [
         $categoryName
      ]);

        $usecase = new CreateCategoryUseCase($this->mockRepo);


        $CategoryCreateResponse = $usecase->execute( $this->mockInputDto );
        
        $this->assertInstanceOf(CategoryCreateOutputDto::class, $CategoryCreateResponse);
        $this->assertEquals($categoryName, $CategoryCreateResponse->name);
        $this->assertEquals('', $CategoryCreateResponse->description);
        

           /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);
        $useCase = new CreateCategoryUseCase($this->spy);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('insert');


        Mockery::close();
 }
}

?>
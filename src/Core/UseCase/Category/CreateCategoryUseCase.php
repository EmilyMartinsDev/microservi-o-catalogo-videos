<?php
namespace  Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateOutputDto;

class CreateCategoryUseCase
 {
    protected $repository;
    public function __construct
    (
          CategoryRepositoryInterface $repository,
    )
    {
        $this->repository  = $repository;
    }

    public function execute(CategoryCreateInputDto $input):CategoryCreateOutputDto
    {
        $category = new Category(
            name: $input->name,
          description:$input->description,
          isActive:$input->isActive
        
        );

        $categoryCreated = $this->repository->insert($category);

        return new CategoryCreateOutputDto(
            id:$categoryCreated->id(),
            name:$categoryCreated->name, 
            description:$categoryCreated->description, 
            is_active:$categoryCreated->isActive,
            created_at: $category->createdAt(),
    );
    }
}


?>
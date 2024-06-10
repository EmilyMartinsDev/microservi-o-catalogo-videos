<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesInputDto;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesOutputDto;

class ListCategoriesUseCase
{
    protected CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ListCategoriesInputDto $input): ListCategoriesOutputDto
    {
        $categories = $this->repository->paginate($input->filter, $input->order, $input->page, $input->totalPage);

        return new ListCategoriesOutputDto(
            items: $categories->items(),
            total: $categories->total(),
            current_page: $categories->currentPage(),
            last_page: $categories->lastPage(),
            first_page: $categories->firstPage(),
            per_page: $categories->perPage(),
            to: $categories->to(),
            from: $categories->from(),

        );

    }
}

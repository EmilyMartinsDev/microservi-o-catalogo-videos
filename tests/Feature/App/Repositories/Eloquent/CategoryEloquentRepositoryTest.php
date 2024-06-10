<?php

namespace Tests\Feature\App\Repositories\Eloquent;

use App\Models\Category as ModelCategory;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Domain\Entity\Category as EntityCategory;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Tests\TestCase;
use Throwable;

class CategoryEloquentRepositoryTest extends TestCase
{
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new CategoryEloquentRepository(new ModelCategory());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInsert()
    {

        $entityCategory = new EntityCategory(name: 'Teste de integracao ', description: 'realizando teste de integracao repo de categoria');
        $output = $this->repository->insert($entityCategory);

        $this->assertInstanceOf(CategoryRepositoryInterface::class, $this->repository);
        $this->assertInstanceOf(EntityCategory::class, $output);
        $this->assertDatabaseHas('categories', [
            'name' => $entityCategory->name,
        ]);

    }

    public function testFindById()
    {
        $entityCategory = ModelCategory::factory()->create();
        $response = $this->repository->findById($entityCategory->id);

        $this->assertInstanceOf(EntityCategory::class, $response);
        $this->assertEquals($entityCategory->id, $response->id);

    }

    public function testFindAll()
    {
        $categories = ModelCategory::factory()->count(50)->create();

        $response = $this->repository->findAll();

        $this->assertEquals(count($categories), count($response));
    }

    public function testPaginate()
    {
        ModelCategory::factory()->count(20)->create();

        $response = $this->repository->paginate();

        $this->assertInstanceOf(PaginationInterface::class, $response);
        $this->assertCount(15, $response->items());
    }

    public function testPaginateWithout()
    {
        $response = $this->repository->paginate();

        $this->assertInstanceOf(PaginationInterface::class, $response);
        $this->assertCount(0, $response->items());
    }

    public function testUpdateIdNotFound()
    {
        try {
            $category = new EntityCategory(name: 'test');
            $this->repository->update($category);

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(NotFoundException::class, $th);
        }
    }

    public function testUpdate()
    {
        $categoryDB = ModelCategory::factory()->create();
        $category = new EntityCategory(id: $categoryDB->id, name: 'name updated');
        $response = $this->repository->update($category);

        $this->assertInstanceOf(EntityCategory::class, $response);
        $this->assertNotEquals($response->name, $categoryDB->name);
        $this->assertEquals('name updated', $response->name);
    }

    public function testDeleteIdNotFound()
    {
        try {
            $this->repository->delete('fake_id');

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(NotFoundException::class, $th);
        }
    }

    public function testDelete()
    {
        $categoryDb = ModelCategory::factory()->create();

        $response = $this->repository
            ->delete($categoryDb->id);

        $this->assertTrue($response);
    }
}

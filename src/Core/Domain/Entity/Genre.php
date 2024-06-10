<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Genre
{
    use MethodsMagicsTrait;

    public function __construct(
        protected string $name,
        protected ?Uuid $id = null,
        protected $isActive = true,
        protected array $categoriesId = [],
        protected ?Datetime $createdAt = null
    ) {
        $this->id = $this->id ?? Uuid::random();
        $this->createdAt = $this->createdAt ?? new DateTime();
        $this->validate();
    }

    public function name()
    {
        return $this->name;
    }

    public function activate()
    {
        $this->isActive = true;
    }

    public function deactivate()
    {
        $this->isActive = false;
    }

    public function addCategory(string $categoryId)
    {
        array_push($this->categoriesId, $categoryId);
    }

    public function update(string $name)
    {
        $this->name = $name;
        $this->validate();
    }

    public function removeCategory(string $categoryId)
    {
        $category = array_search($categoryId, $this->categoriesId, true);
        if ($category !== false) {
            $this->categoriesId = array_values(array_filter($this->categoriesId, function ($cat) use ($categoryId) {
                return $cat !== $categoryId;
            }));
        }
    }

    protected function validate()
    {
        DomainValidation::strMinLength($this->name);
        DomainValidation::strMaxLength($this->name);
    }
}

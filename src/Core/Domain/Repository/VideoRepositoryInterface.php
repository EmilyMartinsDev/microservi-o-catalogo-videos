<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Entity;

interface VideoRepositoryInterface extends EntityRepositoryInterface{
    public function uploadMedia(Entity $entity): Entity;
}
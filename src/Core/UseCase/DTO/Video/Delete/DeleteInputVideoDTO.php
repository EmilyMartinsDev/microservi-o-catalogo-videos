<?php

namespace Core\UseCase\DTO\Video\Delete;

class DeleteInputVideoDTO
{
    public function __construct(
        public string $id
    ) {
    }
}

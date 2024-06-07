<?php

namespace Core\UseCase\DTO\Video\Delete;

class DeleteOutputVideoDTO
{
    public function __construct(
        public bool $deleted
    ) {
    }
}
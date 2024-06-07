<?php

namespace Core\UseCase\DTO\Video\ChangeEncoded;

class ChangeEncodedVideoOutputDTO
{
    public function __construct(
        public string $id,
        public string $encodedPath,
    ) {
    }
}
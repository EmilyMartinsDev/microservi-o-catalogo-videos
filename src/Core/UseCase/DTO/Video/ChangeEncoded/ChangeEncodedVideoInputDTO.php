<?php

namespace Core\UseCase\DTO\Video\ChangeEncoded;

class ChangeEncodedVideoInputDTO
{
    public function __construct(
        public string $id,
        public string $encodedPath,
    ) {
    }
}

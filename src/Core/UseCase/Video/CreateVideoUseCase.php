<?php

namespace Core\UseCase\Video;

use Core\Domain\Repository\VideoRepositoryInterface;
use Core\UseCase\DTO\Video\Create\CreateInputVideoDTO;
use Core\UseCase\DTO\Video\Create\CreateOutputVideoDTO;
use Core\UseCase\Interfaces\FileStorageInterface;
use Core\UseCase\Interfaces\TransactionInterface;
use Core\UseCase\Video\Interfaces\VideoEventManagerInterface;

class CreateVideoUseCase{
    protected VideoRepositoryInterface $repository;
    protected TransactionInterface $transaction;
    protected FileStorageInterface $storage;
    protected   VideoEventManagerInterface $eventManager;

    public function __construct(
        VideoRepositoryInterface $repository,
        TransactionInterface $transaction,
        FileStorageInterface $storage,
        VideoEventManagerInterface $eventManager
    ){
        $this->repository = $repository;
        $this->transaction = $transaction;
        $this->storage = $storage;
        $this->$eventManager  = $eventManager;
    }

    public function exec( CreateInputVideoDTO $input): CreateOutputVideoDTO{

    }
    
}
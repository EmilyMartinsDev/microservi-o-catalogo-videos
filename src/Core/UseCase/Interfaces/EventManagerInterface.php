<?php

namespace Core\UseCase\Interfaces;

interface EventManagerInterface{
    /**
     * @param string $path
     * @param array $_FILES[file]
     */
    public function dispatch(object $event):void; 

}
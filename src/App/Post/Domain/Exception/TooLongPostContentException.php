<?php

declare(strict_types=1);

namespace App\App\Post\Domain\Exception;


class TooLongPostContentException extends \InvalidArgumentException implements \Throwable
{
    public function __construct()
    {
        parent::__construct('Post content can have max 1000 characters.');
    }
}
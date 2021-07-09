<?php

declare(strict_types=1);

namespace App\App\Comment\Domain\Exception;


class TooLongCommentContentException extends \InvalidArgumentException implements \Throwable
{
    public function __construct()
    {
        parent::__construct('Comment content can have max 200 characters.');
    }
}
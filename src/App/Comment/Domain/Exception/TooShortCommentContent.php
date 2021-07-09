<?php

declare(strict_types=1);

namespace App\App\Comment\Domain\Exception;


class TooShortCommentContent extends \InvalidArgumentException implements \Throwable
{
    public function __construct()
    {
        parent::__construct('Comment content can have minimal 8 characters.');
    }
}
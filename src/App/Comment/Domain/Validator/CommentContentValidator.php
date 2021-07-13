<?php

declare(strict_types=1);

namespace App\App\Comment\Domain\Validator;


use App\App\Comment\Domain\Exception\TooLongCommentContentException;
use App\App\Comment\Domain\Exception\TooShortCommentContent;

class CommentContentValidator
{
    const MAX_CONTENT_LENGTH = 200;

    public function isValid(?string $content): bool
    {
        if (strlen($content) > self::MAX_CONTENT_LENGTH) {
            throw new TooLongCommentContentException();
        }
        if ($content === null || strlen($content) < 8) {
            throw new TooShortCommentContent();
        }

        return true;
    }
}
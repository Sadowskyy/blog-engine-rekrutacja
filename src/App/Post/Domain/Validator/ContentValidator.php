<?php

declare(strict_types=1);

namespace App\App\Post\Domain\Validator;


use App\App\Post\Domain\Exception\TooLongPostContentException;

class ContentValidator
{
    const BLOG_CONTENT_LENGTH = 1000;

    public function isValid(string $content): bool
    {
        if ($content > self::BLOG_CONTENT_LENGTH) {
            throw new TooLongPostContentException();
        }

        return true;
    }
}
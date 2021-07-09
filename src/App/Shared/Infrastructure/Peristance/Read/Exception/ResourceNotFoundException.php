<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Peristance\Read\Exception;


final class ResourceNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Resource not found');
    }
}
<?php

declare(strict_types=1);

namespace App\UI\Web\Controller;



use App\App\Shared\Infrastructure\Peristance\Read\Repository\MySqlDatabase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/health')]
class DatabaseHealthController
{
    private MySqlDatabase $mysqlDatabase;

    public function __construct(MySqlDatabase $mysqlDatabase)
    {
        $this->mysqlDatabase = $mysqlDatabase;
    }

    #[Route(name: 'check_health', methods: ['GET'])]
    public function checkHealth(Request $request): Response
    {
        $mysql = null;

        if (
                true === $mysql = $this->mysqlDatabase->isHealthy()
        ) {
            return new Response(200);
        }

        return new Response(500);
    }
}
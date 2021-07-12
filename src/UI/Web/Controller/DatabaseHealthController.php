<?php


namespace App\UI\Web\Controller;



use App\App\Shared\Infrastructure\Peristance\Read\Repository\MySqlDatabase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DatabaseHealthController
{
    private MySqlDatabase $mysqlDatabase;

    public function __construct(MySqlDatabase $mysqlDatabase)
    {
        $this->mysqlDatabase = $mysqlDatabase;
    }

    public function __invoke(Request $request): Response
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
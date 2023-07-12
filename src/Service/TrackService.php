<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Track;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class TrackService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function search(): QueryBuilder
    {
        $trackRepo = $this->entityManager->getRepository(Track::class);

        return $trackRepo->search();
    }
}

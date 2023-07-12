<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class AlbumService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function search(?string $term): QueryBuilder
    {
        /** @var AlbumRepository $repo */
        $repo = $this->entityManager->getRepository(Album::class);

        return $repo->searchByTerm($term);
    }
}

<?php

declare(strict_types=1);

namespace App\Presenter\DataProvider;

use App\Entity\Album;
use Platim\PresenterBundle\DataProvider\DataProviderInterface;
use Platim\PresenterBundle\DataProvider\QueryBuilder\QueryBuilderInterface;
use Platim\PresenterBundle\DoctrineInteraction\QueryBuilderProxy;
use Doctrine\ORM\EntityManagerInterface;

class AlbumDataProvider implements DataProviderInterface
{
    private ?string $term = null;

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function withTerm(?string $term): self
    {
        $clone = clone $this;
        $this->term = $term;

        return $clone;
    }

    public function getQueryBuilder(): QueryBuilderInterface
    {
        $repo = $this->entityManager->getRepository(Album::class);

        return new QueryBuilderProxy($repo->searchByTerm($this->term));
    }
}

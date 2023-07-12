<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class AlbumRepository extends EntityRepository
{
    public function searchByTerm(string $term = null): QueryBuilder
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id');

        if ($term) {
            $qb->andWhere('a.title like :term')
                ->setParameter('term', '%' . trim($term, '%') . '%');
        }

        return $qb;
    }
}

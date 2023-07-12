<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class TrackRepository extends EntityRepository
{
    public function search(): QueryBuilder
    {
        return $this->createQueryBuilder('track')
            ->orderBy('track.id');
    }
}

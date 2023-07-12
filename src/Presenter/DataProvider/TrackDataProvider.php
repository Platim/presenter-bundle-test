<?php

declare(strict_types=1);

namespace App\Presenter\DataProvider;

use App\Entity\Track;
use Platim\PresenterBundle\DataProvider\DataProviderInterface;
use Platim\PresenterBundle\DataProvider\QueryBuilder\QueryBuilderInterface;
use Platim\PresenterBundle\DoctrineInteraction\QueryBuilderProxy;
use Platim\PresenterBundle\Request\Filter\CustomFilterInterface;
use Doctrine\ORM\EntityManagerInterface;

class TrackDataProvider implements DataProviderInterface, CustomFilterInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function getQueryBuilder(): QueryBuilderInterface
    {
        $repo = $this->entityManager->getRepository(Track::class);

        return new QueryBuilderProxy($repo->createQueryBuilder('t'));
    }

    public function getFilterFields(): array
    {
        return [
            'price' => function (QueryBuilderProxy $proxy, string $value): void {
                switch ($value) {
                    case 'low':
                        $proxy->getQueryBuilder()->andWhere('t.unitPrice < 1');
                        break;
                    case 'high':
                        $proxy->getQueryBuilder()->andWhere('t.unitPrice >= 1');
                        break;
                }
            },
            'album' => 't.album',
        ];
    }
}

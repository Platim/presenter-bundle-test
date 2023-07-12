<?php

declare(strict_types=1);

namespace App\Presenter\Entity;

use App\Entity\Track;
use Platim\PresenterBundle\PresenterHandler\PresenterHandlerInterface;

class TrackPresenter implements PresenterHandlerInterface
{
    public function __invoke(Track $track): array
    {
        return [
            'id' => $track->getId(),
            'name' => $track->getName(),
        ];
    }
}

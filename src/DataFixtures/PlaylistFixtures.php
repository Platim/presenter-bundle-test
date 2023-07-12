<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Playlist;
use App\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaylistFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/Playlist.json'), true);
        foreach ($data as $row) {
            $playlist = (new Playlist())
                ->setId($row['PlaylistId'])
                ->setName($row['Name']);
            $manager->persist($playlist);
        }

        $manager->flush();

        $data = json_decode(file_get_contents(__DIR__ . '/Json/PlaylistTrack.json'), true);
        foreach ($data as $row) {
            $playlist = $manager->find(Playlist::class, $row['PlaylistId']);
            $track = $manager->find(Track::class, $row['TrackId']);
            $playlist->getTracks()->add($track);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TrackFixtures::class,
        ];
    }
}

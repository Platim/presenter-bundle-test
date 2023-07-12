<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AlbumFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/Album.json'), true);
        foreach ($data as $row) {
            $artist = $manager->find(Artist::class, $row['ArtistId']);
            $album = (new Album())
                ->setId($row['AlbumId'])
                ->setTitle($row['Title'])
                ->setArtist($artist);
            $manager->persist($album);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ArtistFixtures::class,
        ];
    }
}

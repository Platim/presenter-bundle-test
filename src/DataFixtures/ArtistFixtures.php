<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/Artist.json'), true);
        foreach ($data as $row) {
            $artist = (new Artist())
                ->setId($row['ArtistId'])
                ->setName($row['Name']);
            $manager->persist($artist);
        }

        $manager->flush();
    }
}

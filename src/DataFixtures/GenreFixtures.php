<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/Genre.json'), true);
        foreach ($data as $row) {
            $genre = (new Genre())
                ->setId($row['GenreId'])
                ->setName($row['Name']);
            $manager->persist($genre);
        }

        $manager->flush();
    }
}

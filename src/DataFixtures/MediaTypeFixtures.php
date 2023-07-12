<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\MediaType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MediaTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/MediaType.json'), true);
        foreach ($data as $row) {
            $mediaType = (new MediaType())
                ->setId($row['MediaTypeId'])
                ->setName($row['Name']);
            $manager->persist($mediaType);
        }

        $manager->flush();
    }
}

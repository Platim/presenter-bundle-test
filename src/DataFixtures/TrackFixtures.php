<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Genre;
use App\Entity\MediaType;
use App\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrackFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/Track.json'), true);
        foreach ($data as $row) {
            $album = $row['AlbumId'] ? $manager->find(Album::class, $row['AlbumId']) : null;
            $mediaType = $row['MediaTypeId'] ? $manager->find(MediaType::class, $row['MediaTypeId']) : null;
            $genre = $row['GenreId'] ? $manager->find(Genre::class, $row['GenreId']) : null;
            $track = (new Track())
                ->setId($row['TrackId'])
                ->setName($row['Name'])
                ->setAlbum($album)
                ->setMediaType($mediaType)
                ->setGenre($genre)
                ->setComposer($row['Composer'])
                ->setMilliseconds($row['Milliseconds'])
                ->setBytes($row['Bytes'])
                ->setUnitPrice($row['UnitPrice']);
            $manager->persist($track);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AlbumFixtures::class,
            MediaTypeFixtures::class,
            GenreFixtures::class,
        ];
    }
}

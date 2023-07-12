<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Trait\IdTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Artist
{
    use IdTrait;

    #[ORM\Column(type: 'string', length: 120)]
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}

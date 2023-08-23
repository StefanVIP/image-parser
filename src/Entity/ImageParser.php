<?php

namespace App\Entity;

use App\Repository\ImageParserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ImageParserRepository::class)]
class ImageParser
{
    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    #[Assert\Url()]
    private ?string $url = null;

    public function getUrl(): ?string
    {
        return $this->url;
    }

}

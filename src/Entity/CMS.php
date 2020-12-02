<?php

namespace App\Entity;

use App\Repository\CMSRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CMSRepository::class)
 */
class CMS
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $attribute;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }
}

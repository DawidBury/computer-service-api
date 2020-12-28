<?php

declare(strict_types=1);

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

    public function __construct(string $attribute, string $value)
    {
        $this->attribute = $attribute;
        $this->value = $value;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function setAttribute(string $attribute): self
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}

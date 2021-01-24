<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CMSRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CMSRepository::class)
 */
class CMS
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"cms"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"cms"})
     */
    private $attribute;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"cms"})
     */
    private $value;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({"cms"})
     */
    private $active;

    public function __construct(?string $attribute = null, ?string $value = null)
    {
        $this->attribute = $attribute;
        $this->value = $value;
        $this->active = false;
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

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }
}

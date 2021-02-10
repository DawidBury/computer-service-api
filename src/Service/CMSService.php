<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\CMS;
use App\Exception\NotFoundException;
use App\Exception\ValidationException;
use App\Repository\CMSRepository;
use Doctrine\ORM\EntityManagerInterface;

class CMSService
{
    private $cmsRepository;
    private $em;

    public function __construct(CMSRepository $cmsRepository, EntityManagerInterface $em)
    {
        $this->cmsRepository = $cmsRepository;
        $this->em = $em;
    }

    public function createCMS(string $attribute, string $value): CMS
    {
        $cms = new CMS(
            $attribute,
            $value
        );

        $this->em->persist($cms);
        $this->em->flush();

        return $cms;
    }

    public function getAllCMS(): array
    {
        return $this->cmsRepository->findAll();
    }

    public function getAllActiveCMS(): array
    {
        return $this->cmsRepository->getAllActiveCMS();
    }

    public function updateCMS(int $id, string $attribute, string $value, bool $active): CMS
    {
        $cmsContent = $this->cmsRepository->find($id);

        if (!$cmsContent) {
            throw new NotFoundException($id);
        }

        $cmsContent->setAttribute($attribute);
        $cmsContent->setValue($value);
        $cmsContent->setActive($active);

        $this->em->flush();

        return $cmsContent;
    }
}

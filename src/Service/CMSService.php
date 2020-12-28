<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\CMS;
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
}

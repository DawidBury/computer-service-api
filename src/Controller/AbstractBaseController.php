<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ValidatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractBaseController extends AbstractController
{
    protected $_validatorService;

    public function __construct(ValidatorService $validatorService)
    {
        $this->_validatorService = $validatorService;
    }
}

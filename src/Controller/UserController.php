<?php declare(strict_types=1);


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    public function register(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        return new JsonResponse(['test'], JsonResponse::HTTP_CREATED);
    }
}
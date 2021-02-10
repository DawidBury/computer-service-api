<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constraints\CreateCMSConstraints;
use App\Constraints\UpdateCMSConstraints;
use App\Service\CMSService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CMSController extends AbstractBaseController
{
    public function create(Request $request, CMSService $cmsService): JsonResponse
    {
        $this->_validatorService->validateArray(
            $data = json_decode($request->getContent(), true),
            CreateCMSConstraints::get()
        );

        $cmsContent = $cmsService->createCMS($data['attribute'], $data['value']);

        $serializedCMS = $this->_serializer->normalize($cmsContent, 'array', [
            'groups' => 'cms',
        ]);

        return new JsonResponse($serializedCMS, JsonResponse::HTTP_CREATED);
    }

    public function list(CMSService $cmsService): JsonResponse
    {
        $cmsContent = $cmsService->getAllCMS();

        $serializedCMS = $this->_serializer->normalize($cmsContent, 'array', [
            'groups' => 'cms',
        ]);

        return new JsonResponse($serializedCMS, JsonResponse::HTTP_OK);
    }

    public function listActive(CMSService $cmsService): JsonResponse
    {
        $cmsContent = $cmsService->getAllActiveCMS();

        $serializedCMS = $this->_serializer->normalize($cmsContent, 'array', [
            'groups' => 'cms',
        ]);

        return new JsonResponse($serializedCMS, JsonResponse::HTTP_OK);
    }

    public function update(Request $request, CMSService $cmsService): JsonResponse
    {
        $this->_validatorService->validateArray(
            $data = json_decode($request->getContent(), true),
            UpdateCMSConstraints::get()
        );

        $cmsContent = $cmsService->updateCMS(
            $data['id'],
            $data['attribute'],
            $data['value'],
            $data['active']
        );

        $serializedCMS = $this->_serializer->normalize($cmsContent, 'array', [
            'groups' => 'cms',
        ]);

        return new JsonResponse($serializedCMS, JsonResponse::HTTP_OK);
    }
}

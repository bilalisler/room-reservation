<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends AbstractController
{
    /**
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @param array $headers
     * @param array $context
     * @return JsonResponse
     */
    public function success(mixed $data, string $message = 'success', int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        $data = [
            'message' => $message,
            'data' => $data
        ];

        return $this->json($data, $status, $headers, $context);
    }
}

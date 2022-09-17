<?php

namespace App\Controller;

use App\Service\OrderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class OrderController extends BaseController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/orders', name: 'app_order', methods: ['GET'])]
    public function index(Request $request, OrderService $orderService): Response
    {
        return $this->response($orderService->listOrders(), 200, 'SUCCESS');
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('/order/{id}', name: 'app_order_show', methods: ['GET'])]
    public function show(Request $request, OrderService $orderService): Response
    {
        $orderDetails = $orderService->detail($request->get('id'));
        if ($orderDetails) {
            return $this->response($orderDetails, 200, 'SUCCESS');
        }
        return $this->response([], 404, 'Order not found');
    }

    /**
     * @param Request $request
     * @param OrderService $orderService
     * @return Response
     */
    #[Route('/order', name: 'app_order_create', methods: ['POST'])]
    public function create(Request $request, OrderService $orderService): Response
    {
        // Form validation
        $allData = json_decode($request->getContent());
        $validation = $this->validation->checkNullable($allData, $orderService->getValidationRules());
        if ($validation) {
            return $this
                ->setErrors($validation[0])
                ->response($validation, 400, 'ERROR');
        }

        $createOrder = $orderService->createOrder($allData);
        if ($createOrder) {
            return $this->response($createOrder, 200, 'SUCCESS');
        }

        return $this->response([], 400, 'ERROR');
    }

    /**
     * @param Request $request
     * @param OrderService $orderService
     * @return Response
     */
    #[Route('/order/{id}', name: 'app_order_update', methods: ['PUT'])]
    public function update(Request $request, OrderService $orderService): Response
    {
        // Form validation
        $allData = json_decode($request->getContent());
        $validation = $this->validation->checkNullable($allData, $orderService->getValidationRules());
        if ($validation) {
            return $this
                ->setErrors($validation[0])
                ->response($validation, 400, 'ERROR');
        }

        $updateOrder = $orderService->updateOrder($request->get('id'), $allData);
        if ($updateOrder) {
            return $this->response($updateOrder, 200, 'SUCCESS');
        }

        return $this->response([], 400, 'ERROR');

    }
}

<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ProductController extends BaseController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/products', name: 'listProducts', methods: ['GET'])]
    public function index(Request $request, ProductService $productService): Response
    {
        return $this->response($productService->listProducts(), 200, 'SUCCESS');
    }
}

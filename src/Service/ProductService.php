<?php


namespace App\Service;



use App\Entity\Product;
use App\Object\ProductObject;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ProductService extends AbstractService
{

    /**
     * @return array
     * @throws ExceptionInterface
     */
    public function listProducts(): array
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        $response = [];
        foreach ($products as $product) {
            $response[] = (new ProductObject($product))->serialize();
        }


        return $response;
    }

}
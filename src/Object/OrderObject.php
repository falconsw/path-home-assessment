<?php


namespace App\Object;


use App\Entity\Order;
use App\Entity\User;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class OrderObject extends CoreObject
{

    /**
     * @var int
     */
    private int $id;

    private mixed $product;
    /**
     * @var float
     */
    private float $total;

    private mixed $order_code;

    private mixed $address;

    private mixed $is_shipping = false;

    /**
     * @param Order $entity
     * @throws ExceptionInterface
     */
    public function __construct(Order $entity)
    {
        $this->convertToObject($entity);
    }

    /**
     * @param Order $entity
     * @throws ExceptionInterface
     */
    private function convertToObject(Order $entity): void
    {
        $this->setId($entity->getId());
        $this->setOrderCode($entity->getOrderCode());
        $this->setProduct($entity->getProductId());
        $this->setTotal($entity->getTotal());
        $this->setAddress($entity->getAddress());
        $this->setIsShipping(new \DateTime() > $entity->getShippingDate());

    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @param mixed $address
     */
    public function setAddress(mixed $address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress(): mixed
    {
        return $this->address;
    }

    /**
     * @param mixed $order_code
     */
    public function setOrderCode(mixed $order_code): void
    {
        $this->order_code = $order_code;
    }

    /**
     * @return mixed
     */
    public function getOrderCode(): mixed
    {
        return $this->order_code;
    }


    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    /**
     * @param mixed $product
     * @throws ExceptionInterface
     */
    public function setProduct(mixed $product): void
    {
        $this->product = (new ProductObject($product))->serialize();
    }

    /**
     * @return mixed
     */
    public function getProduct(): mixed
    {
        return $this->product;
    }

    /**
     * @param mixed $is_shipping
     */
    public function setIsShipping(mixed $is_shipping): void
    {
        $this->is_shipping = $is_shipping;
    }

    /**
     * @return mixed
     */
    public function getIsShipping(): mixed
    {
        return $this->is_shipping;
    }



}
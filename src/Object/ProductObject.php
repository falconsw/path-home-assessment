<?php


namespace App\Object;


use App\Entity\Product;

class ProductObject extends CoreObject
{

    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var float
     */
    private float $price;
    /**
     * @var int
     */
    private int $stock;

    /**
     * ProductObject constructor.
     * @param Product $entity
     */
    public function __construct(Product $entity)
    {
        $this->convertToObject($entity);
    }

    /**
     * @param Product $entity
     */
    private function convertToObject(Product $entity): void
    {
        $this->setId($entity->getId());
        $this->setName($entity->getName());
        $this->setPrice($entity->getPrice());
        $this->setStock($entity->getStock());

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

}
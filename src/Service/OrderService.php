<?php


namespace App\Service;



use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use App\Object\OrderObject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;


class OrderService extends AbstractService
{

    /**
     * @var string|UserInterface
     */
    private UserInterface|string $user;

    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        parent::__construct($em);
        $this->user = $container->get('security.token_storage')->getToken()->getUser();
    }

    public function createOrder($all)
    {
        $product = $this->em->getRepository(Product::class)->find($all->productId);
        if (!$product) {
            return false;
        }
        try {
            $order = new Order();
            $order->setOrderCode($this->generateOrderCode());
            $order->setUserId($this->em->getRepository(User::class)->find($this->user));
            $order->setAddress($all->address);
            $order->setProductId($product);
            $order->setTotal($all->quantity * $product->getPrice());
            // this order shipping date is 1 hour later
            $order->setShippingDate(new \DateTime('+1 hours'));

            $this->em->persist($order);
            $this->em->flush();
            return (new OrderObject($order))->serialize();


        } catch (\Exception|ExceptionInterface $e) {
            return false;
        }

    }

    public function getValidationRules(): array
    {
        return [
            'productId',
            'quantity',
            'address',
        ];
    }

    public function generateOrderCode(): string
    {
        return md5(uniqid(mt_rand(), true));
    }

    /**
     * @throws ExceptionInterface
     */
    public function listOrders(): array
    {
        $orders = $this->em->getRepository(Order::class)->findBy(['userId' => $this->user]);

        $response = [];
        foreach ($orders as $order) {
            $response[] = (new OrderObject($order))->serialize();
        }

        return $response;
    }

    /**
     * @throws ExceptionInterface
     */
    public function detail($id)
    {
        $order = $this->em->getRepository(Order::class)->findOneBy(['id' => $id, 'userId' => $this->user]);
        if (!$order) {
            return false;
        }
        return (new OrderObject($order))->serialize();
    }

    public function updateOrder($id, mixed $all)
    {
        $product = $this->em->getRepository(Product::class)->find($all->productId);
        if (!$product) {
            return false;
        }

        $order = $this->em->getRepository(Order::class)->findOneBy(['id' => $id, 'userId' => $this->user]);
        if (!$order || new \DateTime() > $order->getShippingDate()) {
            return false;
        }
        try {
            $order->setAddress($all->address);
            $order->setProductId($product);
            $order->setTotal($all->quantity * $product->getPrice());

            $this->em->persist($order);
            $this->em->flush();
            return (new OrderObject($order))->serialize();
        } catch (\Exception|ExceptionInterface $e) {
            return false;
        }
    }


}
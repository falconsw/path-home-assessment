<?php

namespace App\Service;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class AbstractService
{
    /**
     * @var EntityRepository
     */
    protected EntityRepository $model;

    protected EntityManager $em;

    /**
     * @param EntityManager $em
     * @param null $model
     */
    public function __construct(EntityManager $em, $model=null)
    {
        $this->em = $em;
        if($model) {
            $this->model = $em->getRepository($model);
        }
    }

    /**
     * @return EntityRepository
     */
    public function getModel(): EntityRepository
    {
        return $this->model;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->model->findAll();
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->model->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @param Criteria $criteria
     * @return Collection
     */
    public function matching(Criteria $criteria): Collection
    {
        return $this->model->matching($criteria);
    }

    /**
     * @param $id
     * @param int $lockMode
     * @param null $lockVersion
     * @return null|object
     */
    public function find($id, int $lockMode = LockMode::NONE, $lockVersion = null): ?object
    {
        return $this->model->find($id, $lockMode, $lockVersion);
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return null|object
     */
    public function findOneBy(array $criteria, array $orderBy = null): ?object
    {
        return $this->model->findOneBy($criteria, $orderBy);
    }

    public function save($object): void
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    public function delete($object): void
    {
        $this->em->remove($object);
        $this->em->flush();
    }

    public function entityManager(): EntityManager
    {
        return $this->em;
    }
}
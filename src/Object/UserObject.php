<?php

namespace App\Object;

class UserObject extends CoreObject {

    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $email;
    /**
     * @var array
     */
    private array $roles;



    public function __construct($entity)
    {
        $this->convertToObject($entity);
    }

    private function convertToObject($entity): void
    {
        $this->setId($entity->getId());
        $this->setEmail($entity->getEmail());
        $this->setRoles($entity->getRoles());
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }


}
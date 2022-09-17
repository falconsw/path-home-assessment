<?php


namespace App\Utils;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validation
{
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;


    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $data
     * @param $entity
     * @return array
     */
    public function valid($data, $entity): array
    {
        $checkValid = $this->checkValid($data, $entity);

        if (!empty($checkValid) && count($checkValid)) {
            return $checkValid;
        }


        return [];
    }

    /**
     * @param $data || request json
     * @param $valid
     * @return array
     */
    public function checkNullable($data, $valid): array
    {
        $notKey = array();

        if (is_null($data)) {
            return $valid;
        }

        foreach ($valid as $key) {
            if (!property_exists($data, $key) || (is_string($data->{$key}) && trim($data->{$key}) === '')) {
                $notKey[] = "$key Required";
            }
        }

        return $notKey;
    }

    /**
     * @param $data
     * @param $entity
     * @return array
     */
    private function checkValid($data, $entity): array
    {
        foreach ($data as $key => $value) {
            if (property_exists($entity, $key)) {
                $entity->{'set'.ucwords($key)}($value);
            }
        }


        $errors = $this->validator->validate($entity);

        if (count($errors) > 0) {
            $notKey = array();
            foreach ($errors as $error) {
                $notKey[] = $error->getConstraint()->message ?? $error->getPropertyPath();
            }
            return $notKey;
        }
        return [];
    }
}
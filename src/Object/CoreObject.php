<?php

namespace App\Object;

use Serializable;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CoreObject implements Serializable
{

    /**
     * @throws ExceptionInterface
     */
    public function serialize()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        return (new Serializer($normalizers, $encoders))->normalize($this, 'json');
    }

    public function unserialize(string $data)
    {
        // TODO: Implement unserialize() method.
    }

    public function __serialize(): array
    {
        // TODO: Implement __serialize() method.
    }

    public function __unserialize(array $data): void
    {
        // TODO: Implement __unserialize() method.
    }
}
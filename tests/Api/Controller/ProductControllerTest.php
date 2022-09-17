<?php


namespace App\Tests\Api\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class ProductControllerTest extends ApiTestCase
{
    // get products test case
    /**
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * Get products list test case
     */
    public function testGetProducts(): void
    {
        self::createClient()->request('GET', '/api/products',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getToken("customer1@mail.com", "password"),
                ],
            ]
        );
        self::assertResponseIsSuccessful();
    }


    private function getToken($username, $password): mixed
    {
        $response = self::createClient()->request('POST', '/api/login_check', [
            'json' => compact('username', 'password'),
        ]);

        $arrayResponse = $response->toArray();
        return $arrayResponse['token'];
    }
}
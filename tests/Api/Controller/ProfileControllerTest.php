<?php


namespace App\Tests\Api\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\ResponseInterface;
use function Symfony\Component\String\u;

final class ProfileControllerTest extends ApiTestCase
{
    /**
     *Test user login with a valid username and password and get user profile
     */
    public function testUserProfileDetailsOK(): void
    {
        $response = $this->login('customer1@mail.com', 'password');
        $arrayResponse = $response->toArray();
        $token = $arrayResponse['token'];
        $client = self::createClient();
        $profileResponse = $client->request('GET', '/api/profile', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);
        self::assertResponseIsSuccessful();
        $arrayResponse = $profileResponse->toArray();

        self::assertArrayHasKey('data', $arrayResponse);
        self::assertNotTrue(u($profileResponse->toArray()['data']['id'])->isEmpty());
    }

    public function testUserProfileDetailsNOK(): void
    {
        $client = self::createClient();
        $client->request('GET', '/api/profile');
        self::assertResponseStatusCodeSame(401);
    }


    /**
     * Login try with a given email and password.
     */
    public function login(string $username, string $password): ResponseInterface
    {
        return self::createClient()->request('POST', '/api/login_check', [
            'json' => compact('username', 'password'),
        ]);
    }
}
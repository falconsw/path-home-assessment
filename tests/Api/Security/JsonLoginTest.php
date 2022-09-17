<?php


namespace App\Tests\Api\Security;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

use function Symfony\Component\String\u;

use Symfony\Contracts\HttpClient\ResponseInterface;

final class JsonLoginTest extends ApiTestCase
{
    /**
     *Test that a user can login with a valid username and password
     */
    public function testLoginOK(): void
    {
        $response = $this->login('customer1@mail.com', 'password');
        self::assertResponseIsSuccessful();
        $arrayResponse = $response->toArray();
        self::assertArrayHasKey('token', $arrayResponse);
        self::assertNotTrue(u($response->toArray()['token'])->isEmpty());
    }

    /**
     * Test that a user cannot login with an invalid username and password
     */
    public function testLoginNOK(): void
    {
        $this->login('customer1@mail.com', 'wrong_password');
        self::assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
        self::assertResponseHeaderSame('content-type', 'application/json');
        self::assertJsonEquals([
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' => 'Invalid credentials.',
        ]);
        self::assertJsonContains([
            'message' => 'Invalid credentials.',
        ]);
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
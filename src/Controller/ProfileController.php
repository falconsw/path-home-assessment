<?php

namespace App\Controller;

use App\Object\UserObject;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ProfileController extends BaseController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $user = (new UserObject($this->getUser()))->serialize();

        return $this->response($user, 200, 'SUCCESS');
    }
}

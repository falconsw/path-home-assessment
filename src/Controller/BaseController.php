<?php

namespace App\Controller;

use App\Response\ApiResponse;
use App\Utils\Validation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as Controller;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{

    /**
     * @var array
     */
    private array $errors = [];

    /**
     * @var ApiResponse
     */
    private ApiResponse $apiResponse;

    /**
     * @var Validation
     */
    protected Validation $validation;

    public function __construct(ApiResponse $apiResponse, Validation $validation)
    {
        $this->apiResponse = $apiResponse;
        $this->validation = $validation;
    }

    /**
     * @param $data
     * @param int $httpStatusCode
     * @param null $message
     * @return Response
     */
    public function response($data, int $httpStatusCode = 200, $message = null): Response
    {
        if (count($this->errors) > 0) {
            $this->apiResponse->setErrors($this->errors);
        }

        return $this->apiResponse
            ->responseView(
                $data,
                $httpStatusCode,
                $message
            );
    }

    /**
     * @param $error
     * @return $this
     */
    public function setErrors($error): BaseController
    {
        $this->errors[] = $error;
        return $this;
    }

    public function parseRequest($request){
        return json_decode($request->getContent());
    }

}
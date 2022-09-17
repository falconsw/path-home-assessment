<?php

namespace App\Response;

use Symfony\Component\HttpFoundation\Response;

class ApiResponse extends ApiResponseMessage
{


    /**
     * @var array
     */
    private array $errors = [];


    /**
     * @param $resultSet
     * @param int $code
     * @param string|null $message
     * @return Response
     */
    public function responseView($resultSet, int $code = 200, string $message = null): Response
    {

        $data = array();

        if (!is_null($message) && $message !== '') {
            $message = self::$messages[$message] ?? $message;
            $data = array('message' => $message);
        }

        if (count($this->errors) > 0) {
            $data['errors'] = $this->errors;
        }



        if (($code === 200 && (is_array($resultSet))) || is_object($resultSet)) {
            $data['data'] = $resultSet;
        }


        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode($code);
        $response->setContent(json_encode($data));

        return $response;
    }



    /**
     * @param $error
     * @return $this
     */
    public function setErrors($error): ApiResponse
    {
        $this->errors = $error;
        return $this;
    }


}
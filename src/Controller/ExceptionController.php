<?php


namespace App\Controller;

use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController extends BaseController
{
    /**
     * @param Request $request
     * @param FlattenException $exception
     * @param DebugLoggerInterface|null $logger
     * @return Response
     * Handle api exceptions and return a json response
     */
    public function exception(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null): Response
    {
        $code = $exception->getStatusCode();


        if ($code === 500) {
            $this->setErrors('Line : ' . $exception->getLine())
                ->setErrors('File : ' . $exception->getFile());
        }

        return $this
            ->setErrors('Message : ' . $exception->getMessage())
            ->response([], $code, null);
    }
}
<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
  /**
   * @var ContainerInterface
   */
  protected $container;

  /**
   * @var RequestInterface
   */
  protected $request;

  /**
   * @var HttpResponse
   */
  protected $response;

  public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request)
  {
    $this->container = $container;
    $this->response = $response;
    $this->request = $request;
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $token = $this->request->getHeaderLine('Authorization');

    if (!$token) {
      return $this->response->json([
        'message' => 'Unauthorized',
        'errors' => [
          'token' => 'Token is required'
        ]
      ], 401);
    }

    return $this->response->json([
      'token' => $token
    ], 200);

    return $handler->handle($request);
  }
}

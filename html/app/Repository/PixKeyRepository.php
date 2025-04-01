<?php

namespace App\Repository;

use App\Model\PixKey;
use Pix\{PixKeyRequest, PixKeyId, PixKeyListRequest, PixKeyResponse, PixKeyListResponse};

class PixKeyRepository implements PixKeyRepositoryInterface
{
  public int $http_status = 200;
  protected $pixKeyCollection;

  public function __construct()
  {
    $this->pixKeyCollection = (new PixKey)->collection;
  }

  public function show(PixKeyId $pixKey): PixKeyResponse
  {
    $response = new PixKeyResponse();
    $response->setMessage($pixKey->getId());
    $response->setStatus(200);
    return $response;
  }

  public function index(PixKeyListRequest $pixKey): PixKeyListResponse
  {
    $response = new PixKeyListResponse();
    $response->setPixKeys([]);
    return $response;
  }

  public function store(PixKeyRequest $pixKey): PixKeyResponse
  {
    $response = new PixKeyResponse();
    $response->setMessage("Pix Key created successfully!");
    $response->setStatus(201);
    return $response;
  }

  public function update(PixKeyRequest $pixKey): PixKeyResponse
  {
    $response = new PixKeyResponse();
    $response->setMessage("Pix Key updated successfully!");
    $response->setStatus(200);
    return $response;
  }

  public function delete(PixKeyId $pixKey): PixKeyResponse
  {
    $response = new PixKeyResponse();
    $response->setMessage("Pix Key deleted successfully!");
    $response->setStatus(200);
    return $response;
  }
}

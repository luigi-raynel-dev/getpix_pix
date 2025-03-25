<?php

namespace App\Controller;

use Pix\{PixKey, PixKeyRequest, PixKeyResponse};

class PixKeyController
{
  public function CreatePixKey(PixKeyRequest $pixKey): PixKeyResponse
  {
    var_dump($pixKey->getUserId());
    $response = new PixKeyResponse();
    $response->setMessage("Pix Key stored successfully!");
    $response->setStatus(201);
    return $response;
  }
}

<?php

namespace App\Controller;

use Pix\{PixKeyId, PixKeyRequest, PixKeyResponse, PixKeyListRequest, PixKeyListResponse, PixKeyShowResponse};
use App\Repository\PixKeyRepository;

class PixKeyController
{
  private $repository;

  public function __construct(PixKeyRepository $repository)
  {
    $this->repository = $repository;
  }

  public function CreatePixKey(PixKeyRequest $pixKey): PixKeyResponse
  {
    return $this->repository->store($pixKey);
  }

  public function UpdatePixKey(PixKeyRequest $pixKey): PixKeyResponse
  {
    return $this->repository->update($pixKey);
  }

  public function GetPixKeys(PixKeyListRequest $request): PixKeyListResponse
  {
    return $this->repository->index($request);
  }

  public function GetPixKey(PixKeyId $pixKey): PixKeyShowResponse
  {
    return $this->repository->show($pixKey);
  }

  public function DeletePixKey(PixKeyId $pixKey): PixKeyResponse
  {
    return $this->repository->delete($pixKey);
  }
}

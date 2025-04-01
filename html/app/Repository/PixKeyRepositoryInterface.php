<?php

namespace App\Repository;

use Pix\{PixKeyRequest, PixKeyId, PixKeyListRequest, PixKeyResponse, PixKeyListResponse};

interface PixKeyRepositoryInterface
{
  public function index(PixKeyListRequest $request): PixKeyListResponse;
  public function show(PixKeyId $pixKey): PixKeyResponse;
  public function store(PixKeyRequest $pixKey): PixKeyResponse;
  public function update(PixKeyRequest $pixKey): PixKeyResponse;
  public function delete(PixKeyId $pixKey): PixKeyResponse;
}

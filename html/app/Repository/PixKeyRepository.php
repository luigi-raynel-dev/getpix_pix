<?php

namespace App\Repository;

use App\Model\PixKey;
use Pix\{PixKeyRequest, PixKeyId, PixKeyListRequest, PixKeyResponse, PixKeyListResponse, PixKeyShowResponse};

class PixKeyRepository implements PixKeyRepositoryInterface
{
  public int $http_status = 200;
  protected $pixKeyCollection;

  public function __construct()
  {
    $this->pixKeyCollection = (new PixKey)->collection;
  }

  public function show(PixKeyId $pixKeyRequest): PixKeyShowResponse
  {
    try {
      $id = new \MongoDB\BSON\ObjectId($pixKeyRequest->getId());
    } catch (\MongoDB\Driver\Exception\InvalidArgumentException) {
      $id = null;
    }

    $pixKey = $id ? $this->pixKeyCollection->findOne([
      '_id' => $id,
      'userId' => $pixKeyRequest->getUserId()
    ]) : null;

    $response = new PixKeyShowResponse();
    $response->setPixKey($pixKey ? json_encode($pixKey->getArrayCopy()) : "");

    return $response;
  }

  public function index(PixKeyListRequest $pixKeyRequest): PixKeyListResponse
  {
    $userId = $pixKeyRequest->getUserId();
    $pixKeyList = $this->pixKeyCollection->find(['userId' => $userId]);

    $pixKeys = json_encode(iterator_to_array($pixKeyList));

    $response = new PixKeyListResponse();
    $response->setPixKeys($pixKeys);
    return $response;
  }

  public function store(PixKeyRequest $pixKeyRequest): PixKeyResponse
  {
    $response = new PixKeyResponse();
    try {
      $pixKey = $pixKeyRequest->getPixKey();
      $this->pixKeyCollection->insertOne([
        'key' => $pixKey->getKey(),
        'type' => $pixKey->getType(),
        'bankISPB' => $pixKey->getBankISPB(),
        'belongsTo' => $pixKey->getBelongsTo() ?? null,
        'userId' => $pixKeyRequest->getUserId(),
        'createdAt' => new \MongoDB\BSON\UTCDateTime(),
        'updatedAt' => new \MongoDB\BSON\UTCDateTime(),
      ]);

      $response->setMessage("Pix Key created successfully!");
      $response->setStatus(201);

      return $response;
    } catch (\Exception $e) {
      $response->setMessage("Error creating Pix Key: " . $e->getMessage());
      $response->setStatus(500);
      return $response;
    }
  }

  public function update(PixKeyRequest $pixKeyRequest): PixKeyResponse
  {
    $response = new PixKeyResponse();
    try {
      $pixKey = $pixKeyRequest->getPixKey();
      $this->pixKeyCollection->updateOne(
        [
          '_id' => new \MongoDB\BSON\ObjectId($pixKeyRequest->getId()),
          'userId' => $pixKeyRequest->getUserId()
        ],
        [
          '$set' => [
            'key' => $pixKey->getKey(),
            'type' => $pixKey->getType(),
            'bankISPB' => $pixKey->getBankISPB(),
            'belongsTo' => $pixKey->getBelongsTo() ?? null,
            'updatedAt' => new \MongoDB\BSON\UTCDateTime()
          ]
        ]
      );

      $response->setMessage("Pix Key updated successfully!");
      $response->setStatus(200);

      return $response;
    } catch (\Exception $e) {
      $response->setMessage("Error updating Pix Key: " . $e->getMessage());
      $response->setStatus(500);
      return $response;
    }
  }

  public function delete(PixKeyId $pixKeyRequest): PixKeyResponse
  {
    $response = new PixKeyResponse();
    try {
      $this->pixKeyCollection->deleteOne(
        [
          '_id' => new \MongoDB\BSON\ObjectId($pixKeyRequest->getId()),
          'userId' => $pixKeyRequest->getUserId()
        ]
      );

      $response->setMessage("Pix Key deleted successfully!");
      $response->setStatus(200);

      return $response;
    } catch (\Exception $e) {
      $response->setMessage("Error deleting Pix Key: " . $e->getMessage());
      $response->setStatus(500);
      return $response;
    }
  }
}

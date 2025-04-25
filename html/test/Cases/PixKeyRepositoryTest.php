<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace HyperfTest\Cases;

use PHPUnit\Framework\TestCase;
use App\Repository\PixKeyRepository;
use Pix\PixKeyRequest;
use Pix\PixKey;
use MongoDB\Collection;

class PixKeyRepositoryTest extends TestCase
{
    public function testIndexReturnsListOfPixKeys()
    {
        $request = new \Pix\PixKeyListRequest();
        $request->setUserId('user-001');

        $mockData = [
            ['key' => 'chave1', 'userId' => 'user-001'],
            ['key' => 'chave2', 'userId' => 'user-001'],
        ];

        $mockCursor = new \ArrayIterator($mockData);

        $collectionMock = $this->createMock(\MongoDB\Collection::class);
        $collectionMock->expects($this->once())
            ->method('find')
            ->with(['userId' => 'user-001'])
            ->willReturn($mockCursor);

        $repository = new class($collectionMock) extends \App\Repository\PixKeyRepository {
            public function __construct($collection)
            {
                $this->pixKeyCollection = $collection;
            }
        };

        $response = $repository->index($request);

        $this->assertInstanceOf(\Pix\PixKeyListResponse::class, $response);
        $this->assertStringContainsString('"key":"chave1"', $response->getPixKeys());
        $this->assertStringContainsString('"key":"chave2"', $response->getPixKeys());
    }

    public function testShowReturnsPixKeySuccessfully()
    {
        $mockId = '64d3ca13a5e4f827ecb16b0a';

        $request = new \Pix\PixKeyId();
        $request->setId($mockId);
        $request->setUserId('user-001');

        $expectedResult = new \ArrayObject([
            '_id' => new \MongoDB\BSON\ObjectId($mockId),
            'key' => 'minha-chave',
            'userId' => 'user-001',
        ]);

        $collectionMock = $this->createMock(\MongoDB\Collection::class);
        $collectionMock->expects($this->once())
            ->method('findOne')
            ->with([
                '_id' => new \MongoDB\BSON\ObjectId($mockId),
                'userId' => 'user-001',
            ])
            ->willReturn($expectedResult);

        $repository = new class($collectionMock) extends \App\Repository\PixKeyRepository {
            public function __construct($collection)
            {
                $this->pixKeyCollection = $collection;
            }
        };

        $response = $repository->show($request);

        $this->assertInstanceOf(\Pix\PixKeyShowResponse::class, $response);
        $this->assertStringContainsString('"key":"minha-chave"', $response->getPixKey());
    }

    public function testStorePixKeyAndReturnsSuccessResponse()
    {
        // Criar objetos reais
        $pixKey = new PixKey();
        $pixKey->setKey('12345678900');
        $pixKey->setType('cpf');
        $pixKey->setBankISPB('00000000');

        $request = new PixKeyRequest();
        $request->setPixKey($pixKey);
        $request->setUserId('user-001');

        $collectionMock = $this->createMock(Collection::class);
        $collectionMock->expects($this->once())
            ->method('insertOne')
            ->with($this->callback(function ($data) {
                return $data['key'] === '12345678900';
            }));

        $repository = new PixKeyRepository($collectionMock);
        $response = $repository->store($request);

        $this->assertEquals(201, $response->getStatus());
        $this->assertEquals('Pix Key created successfully!', $response->getMessage());
    }

    public function testUpdatePixKeyAndReturnsSuccessResponse()
    {
        // Criar objetos reais
        $pixKey = new PixKey();
        $pixKey->setKey('12345678900');
        $pixKey->setType('cpf');
        $pixKey->setBankISPB('00000000');

        $request = new PixKeyRequest();
        $request->setPixKey($pixKey);
        $request->setUserId('user-001');
        $request->setId('64d3ca13a5e4f827ecb16b0a');

        $collectionMock = $this->createMock(Collection::class);
        $collectionMock->expects($this->once())
            ->method('updateOne')
            ->with($this->callback(function ($data) {
                return (string) $data['_id'] === '64d3ca13a5e4f827ecb16b0a';
            }));

        $repository = new PixKeyRepository($collectionMock);
        $response = $repository->update($request);

        var_dump($response->getMessage());

        $this->assertEquals(200, $response->getStatus());
        $this->assertEquals('Pix Key updated successfully!', $response->getMessage());
    }
}

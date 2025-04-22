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

        // Mock seguro da Collection
        $collectionMock = $this->createMock(Collection::class);
        $collectionMock->expects($this->once())
            ->method('insertOne')
            ->with($this->callback(function ($data) {
                return $data['key'] === '12345678900';
            }));

        // Injeta no repositório e testa
        $repository = new PixKeyRepository($collectionMock);
        $response = $repository->store($request);

        $this->assertEquals(201, $response->getStatus());
        $this->assertEquals('Pix Key created successfully!', $response->getMessage());
    }
}

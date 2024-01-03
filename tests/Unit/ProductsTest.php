<?php

namespace Unit;

use Codeception\Attribute\After;
use Prhost\Bling\Classes\Collection;
use Tests\Unit\TestCaseBase;

class ProductsTest extends TestCaseBase
{
    #[After('AuthenticationTest::testRequestToken')]
    public function testCreateSimpleProduct()
    {
        global $tokenResponse, $codigo, $id;

        $codigo = $this->faker->uuid();

        $response = $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->create([
                'nome'     => $this->faker->words(3, true),
                'codigo'   => $codigo,
                'tipo'     => 'P', //Produto
                'situacao' => 'A', //Ativo
                'formato'  => 'S', //Simples
            ]);

        $this->assertIsObject($response);
        $this->assertObjectHasProperty('id', $response);
        $this->assertObjectHasProperty('variations', $response);
        $this->assertObjectHasProperty('warnings', $response);
        $this->assertIsInt($response->id);
        $this->assertNull($response->variations);
        $this->assertIsArray($response->warnings);

        $id = $response->id;
    }

    #[After('AuthenticationTest::testRequestToken')]
    public function testGetProducts()
    {
        global $tokenResponse;

        $response = $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->get();

        $this->assertIsArray($response->toArray());
        $this->isInstanceOf(Collection::class, $response);
    }

    #[After('AuthenticationTest::testRequestToken')]
    public function testGetProductById()
    {
        global $tokenResponse, $id;

        $response = $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->getById($id);

        $this->assertIsObject($response);
        $this->assertObjectHasProperty('id', $response);
        $this->assertObjectHasProperty('variacoes', $response);
        $this->assertIsInt($response->id);
        $this->assertIsArray($response->variacoes);
        $this->assertStringContainsString('A', $response->situacao);
    }

    #[After('AuthenticationTest::testRequestToken')]
    public function testUpdateSimpleProduct()
    {
        global $tokenResponse, $id;

        $response = $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->update($id, [
                'nome'     => $this->faker->words(3, true),
                'codigo'   => $this->faker->uuid(),
                'tipo'     => 'P', //Produto
                'situacao' => 'I', //Inativo
                'formato'  => 'S', //Simples
            ]);

        $this->assertIsObject($response);
        $this->assertObjectHasProperty('id', $response);
        $this->assertObjectHasProperty('variations', $response);
        $this->assertObjectHasProperty('warnings', $response);
        $this->assertIsInt($response->id);
        $this->assertNull($response->variations);
        $this->assertIsArray($response->warnings);
    }

    #[After('AuthenticationTest::testRequestToken')]
    public function testUpdateProductSituationToExcluded()
    {
        global $tokenResponse, $id;

        $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->updateSituation($id, 'E');

        $response = $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->getById($id);

        $this->assertIsObject($response);
        $this->assertObjectHasProperty('id', $response);
        $this->assertObjectHasProperty('variacoes', $response);
        $this->assertIsInt($response->id);
        $this->assertIsArray($response->variacoes);
        $this->assertStringContainsString('E', $response->situacao);
    }

    #[After('AuthenticationTest::testRequestToken')]
    public function testDeleteProductById()
    {
        global $tokenResponse, $id;

        $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->deleteById($id);

        $this->getProductNotFound($tokenResponse, $id);
    }

    #[After('AuthenticationTest::testRequestToken')]
    public function testDeleteProducts()
    {
        global $tokenResponse;

        $product1 = $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->create([
                'nome'     => $this->faker->words(3, true),
                'codigo'   => $this->faker->uuid(),
                'tipo'     => 'P', //Produto
                'situacao' => 'A', //Ativo
                'formato'  => 'S', //Simples
            ]);

        $product2 = $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->create([
                'nome'     => $this->faker->words(3, true),
                'codigo'   => $this->faker->uuid(),
                'tipo'     => 'P', //Produto
                'situacao' => 'A', //Ativo
                'formato'  => 'S', //Simples
            ]);

        $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->updateSituation($product1->id, 'E');

        $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->updateSituation($product2->id, 'E');

        $this->bling
            ->setAccessToken($tokenResponse->access_token)
            ->produtos()
            ->delete([$product1->id, $product2->id]);

        $this->getProductNotFound($tokenResponse, $product1->id);
    }

    protected function getProductNotFound($tokenResponse, $id)
    {
        try {
            $this->bling
                ->setAccessToken($tokenResponse->access_token)
                ->produtos()
                ->getById($id);
        } catch (\Exception $e) {
            $this->assertEquals(404, $e->getCode());
            $this->assertStringContainsString($e->getMessage(), 'O recurso requisitado não foi encontrado. Verifique se o endpoint solicitado está correto ou se o ID informado realmente existe no sistema.');
        }
    }
}

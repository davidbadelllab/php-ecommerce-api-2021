<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Attribute\Cache;

/**
 * Product Controller - PHP 8.0 Attributes
 */
#[Route('/api/products', name: 'products_')]
class ProductController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    #[Cache(ttl: 3600, tags: ['products'])]
    public function list(): JsonResponse
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Product 1',
                'price' => 99.99,
                'stock' => 50
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'price' => 149.99,
                'stock' => 30
            ]
        ];

        return $this->json($products);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    #[Cache(ttl: 1800, tags: ['product'])]
    public function show(int $id): JsonResponse
    {
        return $this->json([
            'id' => $id,
            'name' => 'Product ' . $id,
            'price' => 99.99,
            'stock' => 50
        ]);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        // PHP 8.0 Named Arguments example
        $product = $this->createProduct(
            name: $request->get('name'),
            price: floatval($request->get('price')),
            stock: intval($request->get('stock'))
        );

        return $this->json($product, 201);
    }

    // Named arguments demonstration
    private function createProduct(string $name, float $price, int $stock): array
    {
        return [
            'id' => random_int(1, 1000),
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s')
        ];
    }

    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        return $this->json(['message' => 'Product updated']);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        return $this->json([], 204);
    }
}

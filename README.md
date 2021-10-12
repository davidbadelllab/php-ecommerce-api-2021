# E-Commerce REST API

Modern e-commerce REST API built with PHP 8.0, featuring enums, attributes, and named arguments.

## Features

- ✅ Product catalog management
- ✅ Shopping cart system
- ✅ Order processing
- ✅ Payment integration (Stripe)
- ✅ User authentication with JWT
- ✅ Admin panel API
- ✅ Email notifications
- ✅ Redis caching

## Technologies

- **PHP 8.0** (Enums, Attributes, Named Arguments, Union Types)
- **Symfony 5.4**
- **Doctrine ORM**
- **PostgreSQL 13**
- **Redis 6**
- **Stripe API**
- **PHPUnit 9**

## PHP 8.0 Features Used

### Enums
```php
enum OrderStatus: string {
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
```

### Attributes
```php
#[Route('/api/products', methods: ['GET'])]
#[Cache(ttl: 3600)]
public function list(): JsonResponse
{
    // ...
}
```

### Named Arguments
```php
$order = createOrder(
    userId: $userId,
    items: $cartItems,
    shippingAddress: $address,
    paymentMethod: PaymentMethod::STRIPE
);
```

### Union Types
```php
public function processPayment(int|string $orderId): bool
{
    // ...
}
```

## Installation

```bash
# Install dependencies
composer install

# Configure environment
cp .env.example .env

# Run migrations
php bin/console doctrine:migrations:migrate

# Start server
symfony server:start
```

## API Endpoints

### Products
```
GET    /api/products
GET    /api/products/{id}
POST   /api/products         (Admin)
PUT    /api/products/{id}    (Admin)
DELETE /api/products/{id}    (Admin)
```

### Cart
```
GET    /api/cart
POST   /api/cart/items
PUT    /api/cart/items/{id}
DELETE /api/cart/items/{id}
```

### Orders
```
GET    /api/orders
POST   /api/orders
GET    /api/orders/{id}
PUT    /api/orders/{id}/cancel
```

## Project Structure

```
ecommerce-api/
├── src/
│   ├── Controller/
│   │   ├── ProductController.php
│   │   ├── CartController.php
│   │   └── OrderController.php
│   ├── Entity/
│   │   ├── Product.php
│   │   ├── Order.php
│   │   └── User.php
│   ├── Enum/
│   │   ├── OrderStatus.php
│   │   └── PaymentMethod.php
│   ├── Repository/
│   ├── Service/
│   │   ├── CartService.php
│   │   ├── OrderService.php
│   │   └── PaymentService.php
│   └── Attribute/
│       └── Cache.php
├── config/
├── tests/
└── composer.json
```

## Testing

```bash
# Run all tests
php bin/phpunit

# Run with coverage
php bin/phpunit --coverage-html coverage
```

## Author

David Badell - 2021

## License

MIT

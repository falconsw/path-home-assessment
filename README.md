# path-home-assessment

This project basic e-commerce website for a home assessment. The project is built with symfony 5.4 and php 8.1 . The website is built with the following features:

## Docker run command

```bash
docker-compose up -d --build
```

## Composer install command

```bash
docker-compose exec php composer install
```
## Database migration command

```bash
docker-compose exec php bin/console doctrine:migrations:migrate
```

## Database fixtures command

```bash
docker-compose exec php bin/console doctrine:fixtures:load
```

## Generate JWT keys

```bash
docker-compose exec php bin/console lexik:jwt:generate-keypair
```

## Postman collection

[postman.json](postman.json)

## User login information

```bash
user 1:
username: customer1@mail.com
password: password

user 2:
username: customer2@mail.com
password: password

user 3:
username: customer3@mail.com
password: password
```

## API documentation

### Login

```http
POST /api/login_check
```

| Parameter  | Type     | Description            |
|:-----------| :------- |:-----------------------|
| `username` | `string` | **Required**. UserName |
| `password` | `string` | **Required**. Password |

### Responses

| Code | Description |
| :--- | :---------- |
| `200` | OK |
| `401` | Unauthorized |

### Example

```json
{
    "token" : "xxx"
}
```




### Get all products

```http
GET /api/products
```

### Responses

| Code | Description |
| :--- | :---------- |
| `200` | OK |
| `401` | Unauthorized |

### Example

```json
[
    {
      "id": 1,
      "name": "Product 1",
      "price": 120.75,
      "stock": 10
    }
]
```

### Create order

```http
POST /api/order
```

| Parameter  | Type | Description            |
|:-----------|:-----|:-----------------------|
| `productId` | `int` | **Required**. Product Id |
| `quantity` | `int` | **Required**. Quantity |
| `address` | `string` | **Required**. Address |

### Responses

| Code | Description |
| :--- | :---------- |
| `200` | OK |
| `401` | Unauthorized |

### Example

```json
{
  "message": "İşlem Başarılı!",
  "data": {
    "id": 10,
    "address": "test addres",
    "orderCode": "120e158b276cec3d362fad8cb28639f2",
    "total": 603.75,
    "product": {
      "id": 1,
      "name": "Product 1",
      "price": 120.75,
      "stock": 10
    },
    "isShipping": false
  }
}
```

### Get all orders

```http
GET /api/order
```

### Responses

| Code | Description |
| :--- | :---------- |
| `200` | OK |
| `401` | Unauthorized |

### Example

```json
[
    {
      "id": 1,
      "address": "test addres",
      "orderCode": "120e158b276cec3d362fad8cb28639f2",
      "total": 603.75,
      "product": {
        "id": 1,
        "name": "Product 1",
        "price": 120.75,
        "stock": 10
      },
      "isShipping": false
    }
]
```

### Get order by id

```http
GET /api/order/{id}
```

| Parameter  | Type     | Description                |
|:-----------| :------- |:---------------------------|
| `id` | `int` | **Required**. Order Id |

### Responses

| Code | Description |
| :--- | :---------- |
| `200` | OK |
| `401` | Unauthorized |

### Example

```json
{
  "id": 1,
  "address": "test addres",
  "orderCode": "120e158b276cec3d362fad8cb28639f2",
  "total": 603.75,
  "product": {
    "id": 1,
    "name": "Product 1",
    "price": 120.75,
    "stock": 10
  },
  "isShipping": false
}
```

### Update order

```http
PUT /api/order/{id}
```

| Parameter  | Type     | Description                |
|:-----------| :------- |:---------------------------|
| `id` | `int` | **Required**. Order Id |
| `productId` | `int` | **Required**. Product Id |
| `quantity` | `int` | **Required**. Quantity |
| `address` | `string` | **Required**. Address |

### Responses

| Code | Description |
| :--- | :---------- |
| `200` | OK |
| `401` | Unauthorized |

### Example

```json
{
  "message": "İşlem Başarılı!",
  "data": {
    "id": 10,
    "address": "test addres",
    "orderCode": "120e158b276cec3d362fad8cb28639f2",
    "total": 603.75,
    "product": {
      "id": 1,
      "name": "Product 1",
      "price": 120.75,
      "stock": 10
    },
    "isShipping": false
  }
}
```




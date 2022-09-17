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

## User login information

```bash
user 1:
email: customer1@mail.com
password: password

user 2:
email: customer2@mail.com
password: password

user 3:
email: customer3@mail.com
password: password
```
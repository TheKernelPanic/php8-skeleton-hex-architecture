# PHP8 Skeleton 

___

## Installation

Create __.env__ file.

```bash
cp .env.dist .env
```

Install dependencies

```
composer install
```

## Run application

### Docker

```bash 
docker-compose -p php8_skeleton_hex_architecture up -d
```

### PHP server

```bash
php -S 127.0.0.1:80 public/index.php
```
## Usage

### Logger (example)

```php 
$this->container->get('logger')->debug('Foo');
```

## Functional tests

### Static analysis

Run __codesniffer__

```bash
vendor/bin/phpcs -p --standard=ruleset.xml src tests
```

### Unit tests

```bash
vendor/bin/phpunit tests/Unit --configuration phpunit.xml
```
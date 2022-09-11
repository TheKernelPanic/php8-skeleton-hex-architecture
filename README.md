# PHP8 Skeleton 

___

## Run application

### Docker

```bash 
docker-compose -p php8_skeleton_hex_architecture up -d
```

### PHP server

```bash
php -S 127.0.0.1:80 public/index.php
```

## Logger usage (example)

```php 
$this->container->get('logger')->debug('Foo');
```
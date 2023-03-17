# Microservices

Attention créer un fichier "config" à la racine du site contenant un fichier "db_config.php" avec le code suivant adapter à votre DataBase :

```php
<?php
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'microservice');
define('TABLE_PROD', 'ms_prod');
define('TABLE_USERS', 'ms_users');
```
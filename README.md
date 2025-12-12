# kintisoft/sdk (PHP)
### SDK oficial de PHP para la API pública de KintiSoft

El **SDK oficial de KintiSoft para PHP** facilita la integración de la API pública en aplicaciones PHP, servidores externos.

Incluye:

- Cliente HTTP basado en Guzzle  
- Excepciones personalizadas  
- Soporte multi-tenant  

---

## Instalación

```bash
composer require kintisoft/sdk
```

---

## Configuración básica

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use KintiSoft\SDK\Client;

$client = new Client(
    tenant: 'acme',
    apiKey: 'pk_live_xxxxxx',
);
```
---

## Opciones avanzadas

```php
$client = new Client(
    tenant: 'acme',
    apiKey: 'pk_live_xxxxxx',
    baseUrlOverride: 'https://acme.kintisoft.com/api/v1',
    timeout: 15.0,
);
```

---

## Estructura interna

```
src/
  Client.php
  HttpClient.php
  Prospects.php
  Exceptions/
    KintiSoftException.php
```

---

##  Licencia

MIT License

# kintisoft/sdk (PHP)
### Official PHP SDK for the KintiSoft Public API

The official KintiSoft PHP SDK makes it easy to integrate the public API into PHP applications and external servers.

Includes:

- HTTP client based on Guzzle
- Custom exceptions
- Multi-tenant support

---

## Installation

composer require kintisoft/sdk

---

## Basic configuration

require __DIR__ . '/vendor/autoload.php';

use KintiSoft\SDK\Client;

$client = new Client(
    tenant: 'acme',
    apiKey: 'pk_live_xxxxxx',
);

---

## Advanced options

$client = new Client(
    tenant: 'acme',
    apiKey: 'pk_live_xxxxxx',
    baseUrlOverride: 'https://acme.kintisoft.com/api/v1',
    timeout: 15.0,
);

---

## Internal structure

src/
  Client.php
  HttpClient.php
  Prospects.php
  Exceptions/
    KintiSoftException.php

---

## License

MIT License

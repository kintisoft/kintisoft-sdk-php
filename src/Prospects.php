<?php

namespace KintiSoft\SDK;

class Prospects
{
    private HttpClient $http;

    public function __construct(HttpClient $httpClient)
    {
        $this->http = $httpClient;
    }

    /**
     * Crea un nuevo prospecto en el tenant.
     *
     * Equivale a: POST /api/v1/persons/prospects
     *
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    public function create(array $payload): array
    {
        return $this->http->request('POST', '/persons/prospects', $payload);
    }

    // Futuro:
    // public function list(array $filters = []): array { ... }
    // public function get(string $id): array { ... }
}

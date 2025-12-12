<?php

namespace KintiSoft\SDK;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use KintiSoft\SDK\Exceptions\KintiSoftException;

class HttpClientOptions
{
    public function __construct(
        public string  $tenant,
        public string  $apiKey,
        public ?string $baseUrlOverride = null,
        public float   $timeout = 10.0,
    ) {}
}

class HttpClient
{
    private HttpClientOptions $options;
    private GuzzleClient $client;

    public function __construct(HttpClientOptions $options)
    {
        if (empty($options->tenant)) {
            throw new KintiSoftException('tenant is required');
        }
        if (empty($options->apiKey)) {
            throw new KintiSoftException('apiKey is required');
        }

        $this->options = $options;

        $this->client = new GuzzleClient([
            'timeout' => $this->options->timeout,
        ]);
    }

    private function getBaseUrl(): string
    {
        if (!empty($this->options->baseUrlOverride)) {
            return rtrim($this->options->baseUrlOverride, '/');
        }

        return 'https://' . $this->options->tenant . '.kintisoft.com/api/v1';
    }

    /**
     * @param array<string, mixed>|null $body
     * @return array<string, mixed>
     * @throws KintiSoftException
     */
    public function request(string $method, string $path, ?array $body = null): array
    {
        $url = $this->getBaseUrl() . $path;

        $options = [
            'headers' => [
                'x-api-key' => $this->options->apiKey,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ],
        ];

        if ($body !== null) {
            $options['json'] = $body;
        }

        try {
            $response = $this->client->request($method, $url, $options);
        } catch (RequestException $e) {
            if ($e->getResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $contents   = (string) $e->getResponse()->getBody();
                $data       = json_decode($contents, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $data = ['raw' => $contents];
                }

                throw new KintiSoftException(
                    $data['message'] ?? 'Request failed',
                    $statusCode,
                    $data
                );
            }

            throw new KintiSoftException($e->getMessage());
        }

        $contents = (string) $response->getBody();
        $data     = json_decode($contents, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $data = ['raw' => $contents];
        }

        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw new KintiSoftException(
                $data['message'] ?? 'Request failed',
                $response->getStatusCode(),
                $data
            );
        }

        /** @var array<string, mixed> $data */
        return $data;
    }
}

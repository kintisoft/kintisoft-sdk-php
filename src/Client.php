<?php

namespace KintiSoft\SDK;

class Client
{
    private HttpClient $http;

    /** @var Prospects */
    public Prospects $prospects;

    public function __construct(
        string  $tenant,
        string  $apiKey,
        ?string $baseUrlOverride = null,
        float   $timeout = 10.0
    ) {
        $options = new HttpClientOptions(
            tenant: $tenant,
            apiKey: $apiKey,
            baseUrlOverride: $baseUrlOverride,
            timeout: $timeout,
        );

        $this->http = new HttpClient($options);

        // módulos
        $this->prospects = new Prospects($this->http);
    }
}

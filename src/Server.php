<?php

namespace Envoyr\Froxlor;

use GuzzleHttp\Client;

class Server
{
    public Customers $customers;
    protected Client $client;
    protected string $apiKey;
    protected string $apiSecret;
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new Client([
            'base_uri' => $config['host']
        ]);
        $this->apiKey = $config['key'];
        $this->apiSecret = $config['secret'];

        $this->customers = $this->customers();
    }

    private function customers(): Customers
    {
        return new Customers($this);
    }

    public function request($command, array $attributes = [], bool $clear_empty_attributes = false): array
    {
        if ($clear_empty_attributes) {
            $attributes = array_filter($attributes, fn($value) => !is_null($value) && $value !== '');
        }

        $payload = [
            'command' => $command,
            'params' => $attributes
        ];
        
        $token = base64_encode(sprintf('%s:%s', $this->apiKey, $this->apiSecret));

        $response = $this->client->post("api.php", [
            'headers' => [
                'Authorization' => 'Basic ' . $token,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($payload)
        ]);

        $payload = json_decode($response->getBody(), true);

        return $payload['data'];
    }

    public function customer(string $id): Customer
    {
        return new Customer($this, $id);
    }
}

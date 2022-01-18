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
            'header' => [
                'apikey' => $this->apiKey,
                'secret' => $this->apiSecret,
            ],
            'body' => [
                'command' => $command,
                'params' => $attributes
            ]
        ];

        $response = $this->client->post("api.php", [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($payload)
        ]);

        $payload = json_decode($response->getBody(), true);

        return $payload['data'];
    }

    public function customer(string $loginname): Customer
    {
        return new Customer($this, $loginname);
    }
}

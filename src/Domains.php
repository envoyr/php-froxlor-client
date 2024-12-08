<?php

namespace Envoyr\Froxlor;

class Domains
{
    public Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function create(
        string $domain,
        bool $letsencrypt = false,
        ?string $description = null,
        bool $isemaildomain = true,
        bool $caneditdomain = true
    ): array
    {
        return $this->customer->server->request('Domains.add', [
            'customerid' => $this->customer->id,
            'domain' => $domain,
            'letsencrypt' => $letsencrypt,
            'isemaildomain' => $isemaildomain,
            'caneditdomain' => $caneditdomain,
            'description' => $description,
        ]);
    }

    public function list(): array
    {
        return $this->customer->server->request('Domains.listing', [
            'sql_search' => [
                'c.customerid' => [
                    'op' => '=',
                    'value' => $this->customer->id,
                ]
            ],
        ]);
    }
}
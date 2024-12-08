<?php

namespace Envoyr\Froxlor;

class Domains
{
    public Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function create(string $domain, bool $letsencrypt = false): array
    {
        return $this->customer->server->request('Domains.add', [
            'customerid' => $this->customer->id,
            'domain' => $domain,
            'letsencrypt' => $letsencrypt,
            'isemaildomain' => true,
            'caneditdomain' => true,
        ]);
    }

    public function list(): array
    {
        return $this->customer->server->request('Domains.listing', [
            'sql_search' => [
                'customerid' => [
                    'op' => '=',
                    'value' => $this->customer->id,
                ]
            ],
        ]);
    }
}
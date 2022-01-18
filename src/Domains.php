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
            'loginname' => $this->customer->loginname,
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
                'loginname' => [
                    'op' => '=',
                    'value' => $this->customer->loginname,
                ]
            ],
        ]);
    }
}
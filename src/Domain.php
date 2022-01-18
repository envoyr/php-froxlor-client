<?php

namespace Envoyr\Froxlor;

class Domain
{
    public array $attributes;
    public Customer $customer;
    public string $domainname;

    public function __construct(Customer $customer, string $domainname)
    {
        $this->domainname = $domainname;
        $this->customer = $customer;
        $this->attributes = $this->customer->server->request('Domains.get', [
            'domainname' => $this->domainname
        ]);
    }

    public function update(array $attributes): array
    {
        return $this->customer->server->request(
            'Domains.update',
            array_merge($attributes, [
                'domainname' => $this->domainname,
            ])
        );
    }

    public function delete(): array
    {
        return $this->customer->server->request('Domains.delete', [
            'domainname' => $this->domainname
        ]);
    }
}